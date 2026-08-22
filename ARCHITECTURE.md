# Architecture

## Overview

This project is a Laravel corporate website backed by a small content management system. Public pages read content from relational tables while a dedicated administrator guard protects content-management routes.

## Request Flow

```text
Browser
  |
  +--> GET / --------------------------------+
  |                                          |
  |                                      HomeController
  |                                          |
  |                             Eloquent models: Service, About,
  |                             Qwes, News, Custom, Team, Say
  |                                          |
  |                                    public Blade view
  |
  +--> POST /forms/contact.php --> ContactController --> validation --> Mail
  |
  +--> /admin/login --> AdminLoginRequest --> admin guard
                                         |
                                         +--> /admin/* CMS resources
```

## Authentication

The application uses Laravel's session authentication with a dedicated `admin` guard and `Admin` model. Public administrator registration is disabled. Administrators are created through deployment/demo seeding or controlled database administration.

## CMS Resources

The administrator area manages:

- Services
- Company profile/about content
- FAQs
- News
- Client logos/images
- Team members
- Testimonials

Each resource uses validated create/update workflows. Image resources store files through Laravel's public filesystem and remove replaced/deleted files where appropriate. Administrator write forms remain protected by Laravel's standard web CSRF middleware.

## Public Rendering

`HomeController` composes the current public content in one place and passes it to the public `in.blade.php` view. This keeps read-only website rendering separate from administrator write operations.

## Contact Flow

The existing Arsha/BootstrapMade public template posts to the legacy-compatible `/forms/contact.php` path. Laravel handles that path with `ContactController`, validates all submitted fields, rate limits the endpoint, and sends the message through Laravel Mail.

Because the inherited static template does not render a Laravel CSRF token in that form, this single public endpoint is explicitly exempted from CSRF verification. It does not modify authenticated application state. `SECURITY.md` documents this boundary and recommends adding a native Laravel CSRF token if the public template is redesigned later.

## Verification

GitHub Actions validates repository reproducibility by running dependency installation, migrations/seeding, route inspection, Blade compilation, automated tests, PHP syntax checks, and the frontend production build.
