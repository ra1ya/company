# Architecture

## Overview

This project is a Laravel corporate website backed by a small content management system. Public pages read content from relational tables while a dedicated administrator guard protects content-management routes.

## Request Flow

```text
Browser
  |
  +--> GET / ----------------------------+
  |                                      |
  |                                  HomeController
  |                                      |
  |                         Eloquent models: Service, About,
  |                         Qwes, News, Custom, Team, Say
  |                                      |
  |                                public Blade view
  |
  +--> POST /contact --> ContactController --> validation --> Mail
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

Each resource uses validated create/update workflows. Image resources store files through Laravel's public filesystem and remove replaced/deleted files where appropriate.

## Public Rendering

`HomeController` composes the current public content in one place and passes it to the public home view. This keeps read-only website rendering separate from administrator write operations.

## Contact Flow

The public contact form posts to a Laravel controller rather than a template PHP endpoint. Input is validated, CSRF-protected by the web middleware group, throttled at the route level, and delivered with Laravel Mail using the configured mailer.

## Verification

GitHub Actions is intended to validate that the repository remains reproducible by running dependency installation, migrations/seeding, route inspection, Blade compilation, automated tests, PHP syntax checks, and the frontend production build.
