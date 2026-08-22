# Security Policy

This repository is a portfolio/demo corporate website and content-management system.

## Controls Demonstrated

- Dedicated Laravel `admin` session guard
- Public administrator registration disabled
- Rate-limited administrator login
- Protected CMS routes under `auth:admin`
- Validated CMS create/update requests
- Image type and size validation
- Cleanup of replaced/deleted uploaded files
- Admin profile and password updates scoped to the admin guard
- Sanitized fictional demo administrator data
- Throttled public contact endpoint
- Automated migrations, tests, syntax checks, route verification, Blade compilation, and frontend build in CI

## Production Expectations

Before a production deployment, configure HTTPS, a strong `APP_KEY`, production database credentials, secure mail credentials, appropriate session/cookie settings, backups, monitoring, least-privilege database access, and deployment-specific rate limits. Replace all demo credentials.

The legacy Bootstrap template contact action is intentionally handled by a Laravel endpoint and is excluded from CSRF validation because it does not mutate authenticated state; it is separately validated and rate limited. A production redesign should prefer rendering a Laravel CSRF token directly in the form.

## Reporting

Please report security issues privately to the repository owner rather than opening a public issue containing sensitive details.
