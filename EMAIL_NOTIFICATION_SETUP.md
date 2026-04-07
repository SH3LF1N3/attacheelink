# Email + Notification Integration Setup Guide

## Overview
The system is now configured to send both **in-app notifications** and **emails** when:
- Application status changes (pending → review → shortlisted → selected/rejected)
- Interview is scheduled

## How It Works

### 1. User Notification Preferences
Each user has a `NotificationPreference` record with two toggles:
- `in_app` - Show in-app notifications (defaults to TRUE)
- `email` - Send email notifications (defaults to TRUE)

**Default Behavior:** Both enabled for all new users. Users can customize in settings.

### 2. Application Status Changed → Notification + Email

**Flow:**
```
Company clicks "Shortlist" button
        ↓
Apps::updateStatus() called with new status
        ↓
Application status updated in database
        ↓
NotificationService::statusChangedByUname() called
        ↓
        ├─→ Create in-app notification (if in_app = true)
        │   └─→ Notifydb::send() stores in notifications table
        │
        └─→ Send email (if email = true)
            └─→ ApplicationStatusMail queued/sent
                └─→ resources/views/emails/application-status.blade.php
```

**Supported Statuses:**
- `pending` - Pending
- `review` - Under Review
- `shortlisted` - Shortlisted ✨
- `interview_scheduled` - Interview Scheduled
- `selected` - Selected ✨
- `rejected` - Not Successful

### 3. Interview Scheduled → Notification + Email

**Flow:**
```
Company fills interview form (date, time, type, location/link)
        ↓
Apps::scheduleInterview() called
        ↓
Interview record created
Application status → 'interview_scheduled'
        ↓
        ├─→ Create in-app notification
        │   └─→ With all interview details
        │
        └─→ Send email (if email = true)
            └─→ InterviewScheduledMail sent
                └─→ resources/views/emails/interview-scheduled.blade.php
```

## Configuration

### Email Setup (SMTP)

The system uses Brevo (formerly Sendinblue) for email delivery. Configure in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your-brevo-email@example.com
MAIL_PASSWORD=xkeysib-your-api-key-here
MAIL_FROM_ADDRESS=noreply@attachke.ac.ke
MAIL_FROM_NAME="AttachKE"
```

**Getting Brevo API Key:**
1. Sign up at https://www.brevo.com
2. Go to Settings → SMTP & API
3. Copy your SMTP API key (starts with `xkeysib-`)
4. Add to `.env` file

### Alternative Email Drivers

You can also use:
- **Mailgun**: `MAIL_MAILER=mailgun`
- **SendGrid**: `MAIL_MAILER=sendgrid`
- **AWS SES**: `MAIL_MAILER=ses`
- **Log (for testing)**: `MAIL_MAILER=log` - emails saved to `storage/logs`

## Testing

### Test Scenario 1: Status Update Email

1. Login as Admin or Company
2. Go to Applications
3. Find an application with "pending" status
4. Click "Mark as Shortlisted"
5. Check student's email inbox (should receive shortlisted notification)
6. Check student's in-app notifications in dashboard

### Test Scenario 2: Interview Scheduled Email

1. Login as Admin or Company
2. Go to Applications
3. Find an application
4. Scroll down and find "Schedule Interview" section
5. Fill in:
   - Interview Date: Future date
   - Interview Time: HH:MM format
   - Type: Physical or Online
   - Location/Link: Address or Zoom link
   - Notes (optional): Any additional info
6. Click "Schedule Interview"
7. Check student's email inbox (should receive interview details)
8. Check in-app notifications

### Test Scenario 3: Check Notification Preferences

1. Login as Student
2. Go to Settings → Notification Preferences (if available)
3. Toggle email/in-app on/off
4. Status update/interview scheduled → should follow toggle settings

### Test with Log Driver (for development)

To test without actual email sending:

```env
MAIL_MAILER=log
```

All emails will be logged to `storage/logs/laravel.log`

To see them:
```bash
tail -f storage/logs/laravel.log
```

## Email Templates

### Email 1: Application Status Changed
**File**: `resources/views/emails/application-status.blade.php`
**Triggered**: When status changes
**Data Passed**:
- `$studentName` - Student's first name
- `$opportunityTitle` - Job position title
- `$orgName` - Organization name
- `$status` - New status (shortlisted, rejected, etc.)
- `$message` - Optional message from company

### Email 2: Interview Scheduled
**File**: `resources/views/emails/interview-scheduled.blade.php`
**Triggered**: When interview is scheduled
**Data Passed**:
- `$studentName` - Student's first name
- `$opportunityTitle` - Job position title
- `$orgName` - Organization name
- `$interviewDate` - Interview date (YYYY-MM-DD)
- `$interviewTime` - Interview time (HH:MM)
- `$interviewType` - "physical" or "online"
- `$locationOrLink` - Address or meeting link
- `$notes` - Additional notes

## Customizing Email Templates

Edit the templates in `resources/views/emails/`:

1. **Colors**: Use hex codes for consistency (e.g., `#182F4D` for navy, `#0f766e` for teal)
2. **Copy**: Update the success/rejection messages
3. **Logo**: Update the "A" logo in header section
4. **Company Name**: Change "AttachKE" to your branding

## Debugging

### Check Email Logs

```bash
tail -f storage/logs/laravel.log | grep -i mail
```

### Check Notification Records

In database:
```sql
SELECT * FROM notifydbs WHERE uname = 'student_username' ORDER BY created_at DESC LIMIT 5;
```

### Verify Preferences

```sql
SELECT * FROM notification_preferences WHERE user_id = 123;
```

## Troubleshooting

### Emails Not Sending

1. Check mail driver is configured: `php artisan config:cache`
2. Verify SMTP credentials in `.env`
3. Check email logs: `tail -f storage/logs/laravel.log`
4. Test manually:
   ```bash
   php artisan tinker
   >>> Mail::to('test@example.com')->send(new \App\Mail\ApplicationStatusMail('John', 'Software Engineer', 'Acme Inc', 'shortlisted'));
   ```

### User Not Receiving Emails

1. Check `notification_preferences.email = 1` for that user
2. Verify user's email address is correct
3. Check spam folder
4. Verify SMTP host/port are correct
5. Check logs for delivery errors

### SMTP Authentication Failed

1. Verify username/password in `.env`
2. Brevo API key must start with `xkeysib-`
3. SSL/TLS port should be `587` or `465`
4. Run `php artisan config:clear`

## Database Migrations

The necessary tables are already created:
- `notification_preferences` - Store user preferences
- `notifydbs` - Store in-app notifications
- `applications` - Store application records
- `interviews` - Store interview details

## API Integration Points

If you're building a mobile app or external integration:

### Notification Status
```
GET /api/notifications?user_id=123
```

### User Preferences
```
GET /api/notification-preferences
PATCH /api/notification-preferences
```

## Production Checklist

- [ ] SMTP credentials configured
- [ ] Email domain verified with Brevo/provider
- [ ] From email address set correctly
- [ ] Tested status change email flow
- [ ] Tested interview scheduled email flow
- [ ] Monitored logs for delivery errors
- [ ] Set up proper error handling
- [ ] Backup email provider as fallback
- [ ] User notification preferences UI completed

## Support

For issues:
1. Check `storage/logs/laravel.log`
2. Verify `.env` configuration
3. Run `php artisan migrate:refresh --seed` for test data
4. Check database records for notification preferences
