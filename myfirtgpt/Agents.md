# Agents.md — Tech CMS Engineering & AI Agent Instructions

## Mission
Build a production-grade Technology Content Management System (Tech CMS) using Laravel, PHP, MySQL, Blade, Tailwind CSS, custom CSS, Alpine.js, custom JavaScript, and Swiper.js.

The system must be secure by default, maintainable, accessible, responsive, testable, observable, and suitable for real production workloads.

Do not optimize for speed of implementation at the expense of security, correctness, accessibility, or maintainability.

## Core Engineering Principles
1. Security first.
2. Correctness before convenience.
3. Prefer Laravel conventions and framework protections over custom implementations.
4. Keep responsibilities separated and code cohesive.
5. Use small, testable units.
6. Prefer explicit validation and authorization.
7. Treat all client input as untrusted.
8. Never expose secrets, credentials, tokens, stack traces, or sensitive internal data.
9. Preserve backward compatibility unless a breaking change is explicitly required.
10. Do not silently weaken security controls to make a feature work.
11. Document meaningful architectural and security decisions.
12. Use progressive enhancement where practical.
13. Build accessibility and mobile responsiveness from the beginning.

## Recommended Architecture
Use conventional modern Laravel structure:

- app/Models — Eloquent models.
- app/Http/Controllers — thin HTTP orchestration.
- app/Http/Requests — validation and input normalization.
- app/Policies — authorization.
- app/Services — business/application services.
- app/Actions — focused use cases when useful.
- app/Jobs — asynchronous work.
- app/Events and app/Listeners — application events.
- app/Notifications — notifications.
- app/Rules — reusable validation rules.
- app/Support — narrowly scoped shared utilities.
- database/migrations — schema evolution.
- database/seeders — safe seed data.
- resources/views — Blade templates.
- resources/css — Tailwind and custom CSS.
- resources/js — Alpine.js and custom JavaScript.
- routes — route definitions only.
- tests/Feature — application behavior.
- tests/Unit — isolated business logic.

Prefer dependency injection over global/static access.

Use abstractions only where they provide real value. Avoid creating interfaces and layers purely for ceremony.

## CMS Capabilities
Design for common technology publishing workflows:

- Articles and long-form content
- Authors and profiles
- Categories and tags
- Featured content
- Draft, review, scheduled, published, and archived states
- Scheduling
- Slugs and canonical URLs
- Media/images
- Search and pagination
- Related content
- Revisions/versioning where required
- SEO metadata
- Open Graph/Twitter metadata
- XML sitemap
- RSS/feed support where required
- Contact and newsletter forms
- Media library
- Admin dashboard
- User management
- Roles and permissions
- Audit logging
- System settings
- Notifications
- Appropriate admin health/status views

Separate public and administrative concerns. Use dedicated admin authorization and middleware.

## Authentication & Authorization
Use Laravel's supported authentication mechanisms.

Requirements:
- Hash passwords using Laravel's password hashing facilities.
- Never store plaintext passwords.
- Enforce appropriate password rules.
- Rate-limit authentication and recovery endpoints.
- Use secure session cookies.
- Regenerate the session after successful authentication and privilege changes.
- Invalidate sessions appropriately on logout and security-sensitive account changes.
- Use policies/gates and roles/permissions.
- Deny by default when access is not explicitly granted.
- Protect admin routes separately.
- Consider MFA/2FA for privileged accounts.
- Use secure password-reset and email-verification flows.
- Avoid unnecessary user enumeration.
- Enforce authorization inside sensitive services/actions where direct-call assumptions could be unsafe.

Every protected object lookup must verify ownership or permission.

## OWASP-Aligned Security

### Input Validation
- Validate every externally supplied value.
- Use Form Request classes for non-trivial requests.
- Normalize input where appropriate.
- Use allowlists for constrained fields.
- Validate file type, MIME type, extension, size, and content when accepting uploads.

### SQL Injection
- Use Eloquent or parameterized query builder bindings.
- Never concatenate untrusted input into SQL.
- Parameterize every dynamic value in raw SQL.

### XSS
- Use Blade escaped output by default.
- Avoid raw HTML output for untrusted content.
- Sanitize rich HTML with a well-maintained sanitizer when HTML input is required.
- Never put untrusted values into innerHTML.
- Prefer safe DOM APIs and escaped templates.
- Consider a Content Security Policy where compatible.

### CSRF
- Keep Laravel CSRF protection active for browser state-changing requests.
- Do not disable CSRF globally.
- Use an appropriate authentication model for APIs instead of copying browser-session assumptions.

### IDOR / BOLA / Privilege Escalation
- Treat every object ID supplied by the client as untrusted.
- Use policies and scoped queries.
- Never fetch arbitrary records by ID and assume the caller is authorized.
- Test forbidden access explicitly.

### Mass Assignment
- Explicitly control assignable attributes.
- Use $fillable or carefully controlled $guarded.
- Never assign an entire request payload to a model without validation and assignment controls.

### Session Security
- Use Secure, HttpOnly, and appropriate SameSite cookie settings.
- Require HTTPS in production.
- Regenerate sessions on authentication and privilege changes.
- Use an appropriate session lifetime.
- Never expose session identifiers in URLs.

### File Upload Security
- Never trust original filenames.
- Generate server-side filenames.
- Store uploads outside executable web roots where practical.
- Validate MIME/type and size.
- Reject executable content.
- Process images safely.
- Prevent path traversal.
- Never allow client input to choose arbitrary filesystem paths.

### SSRF
For server-side URL fetching:
- Allow only appropriate protocols.
- Block internal/private network ranges when appropriate.
- Restrict redirects.
- Enforce timeouts.
- Limit response sizes.
- Prevent access to metadata/internal services.

### Deserialization
Never unserialize arbitrary untrusted PHP data. Prefer JSON or structured formats.

### Command Execution
Avoid shell execution. If unavoidable, use strict allowlists and safe process APIs. Never pass untrusted user input to shell commands.

## Database & MySQL Standards
Use normalized relational design unless measured requirements justify denormalization.

- Use migrations for schema changes.
- Use appropriate foreign keys and unique constraints.
- Index according to query patterns.
- Prefer NOT NULL when null has no business meaning.
- Do not store comma-separated relationships in one column.
- Use transactions for multi-step atomic workflows.
- Keep transactions as short as practical.
- Design for concurrency and avoid lost updates.
- Use locking only when necessary.
- Avoid N+1 queries.
- Eager-load relationships when needed.
- Paginate large collections.
- Select only required fields in performance-sensitive queries.
- Use soft deletes only when they have clear product/audit value.
- Protect sensitive data appropriately at the application layer.
- Never commit database credentials.

For multi-write workflows, ensure failure cannot leave misleading partial state.

## Laravel Configuration & Secrets
Use environment variables for secrets and environment-specific settings.

Never commit:
- .env
- API keys
- private tokens
- SMTP passwords
- database passwords
- encryption keys
- OAuth client secrets
- production credentials

Production expectations:
- APP_DEBUG=false
- HTTPS enforced
- Secure cookie settings
- Correct proxy configuration
- Restrictive CORS where applicable
- Safe filesystem permissions
- Sensitive-data redaction in logs

Never expose configuration, environment values, exception details, SQL errors, or framework internals to users.

## API Security
For APIs:
- Authenticate explicitly.
- Authorize every protected resource.
- Validate payloads.
- Use consistent error responses.
- Rate-limit abuse-prone endpoints.
- Paginate collections.
- Enforce reasonable request/body sizes.
- Avoid sensitive fields by default.
- Use API Resources or equivalent response shaping.
- Version APIs when compatibility requires it.
- Consider idempotency for retryable side effects.
- Log security failures without leaking secrets.

## Rate Limiting & Abuse Protection
Apply intentional limits to:
- Login
- Password reset
- Email verification
- Contact forms
- Newsletter subscriptions
- Expensive search
- Public APIs
- Admin actions
- File uploads
- Token/auth endpoints

Rate limiting is an abuse-control layer, not a replacement for authorization.

## Idempotency & Concurrency
For retryable or double-submission-prone operations:
- Use idempotency keys where appropriate.
- Enforce uniqueness for idempotency records.
- Process duplicate retries deterministically.
- Use transactions for state changes.
- Use locking or atomic updates for race-prone transitions.
- Do not rely solely on frontend button disabling.

## Audit Logging & Observability
Log important events:
- Login/logout
- Failed authentication
- Password and MFA changes
- Role/permission changes
- Content publishing/unpublishing
- Administrative changes
- Sensitive settings changes
- Media operations
- API authentication failures
- Suspicious access patterns

Audit records should be append-oriented and protected from ordinary users.

Never log passwords, session tokens, API secrets, authorization headers, or unnecessary sensitive personal data.

Include enough context to investigate: actor, action, target, result, time, and security-relevant request/device/IP context where lawful and necessary.

## Error Handling
- Show controlled user-facing errors.
- Log technical details securely.
- Use correct HTTP status codes.
- Do not silently swallow exceptions.
- Do not expose stack traces in production.
- Distinguish validation, authorization, not-found, conflict, and unexpected errors.
- Catch exceptions only when recovering, adding useful context, or deliberately rethrowing.

## Frontend Technology Rules

### Tailwind CSS
Tailwind is the primary utility styling system.
- Establish consistent tokens for color, typography, spacing, radii, shadows, and responsive behavior.
- Avoid arbitrary values when an existing token can be used.
- Extract repeated UI patterns into reusable components.

### Custom CSS
Use custom CSS for design-system primitives, complex visual treatments, third-party overrides, keyframes, and cases where utility classes become less maintainable.

Do not create a competing second design system.

### Alpine.js
Use Alpine.js for localized reactive behavior:
- Dropdowns
- Modals
- Tabs
- Accordions
- Toasts
- Filters
- Mobile navigation
- Small interactive controls

Avoid turning Alpine into a large application-wide state system.

### Custom JavaScript
- Prefer ES modules.
- Avoid globals.
- Keep functions focused.
- Handle async failures.
- Never inject untrusted HTML.
- Use progressive enhancement.
- Debounce/throttle expensive events where appropriate.

### Swiper.js
Use Swiper.js for touch-friendly sliders and carousels.

Requirements:
- Accessible controls and labels
- Keyboard support where applicable
- Sensible autoplay
- Respect prefers-reduced-motion
- Do not hide critical information behind interaction alone
- Intentional responsive breakpoints
- Lazy-load expensive media when appropriate

## Modern UI/UX
Use modern product-quality UI/UX practices:
- Mobile-first responsive design
- Clear visual hierarchy
- Consistent spacing and typography
- Predictable navigation
- Obvious primary actions
- Useful empty states
- Loading/skeleton states where appropriate
- Success/error feedback
- Destructive-action confirmation
- Accessible forms
- Keyboard navigation
- Visible focus states
- Touch-friendly targets
- Consistent component states
- Good information density without clutter
- Responsive tables or mobile alternatives
- Reduced-motion support
- Dark/light mode architecture when needed

Avoid visual noise, tiny controls, inaccessible contrast, purposeless animation, inconsistent components, modal overuse, and hover-only critical actions.

## Accessibility
Target WCAG 2.2 AA as the working standard.

- Semantic HTML
- Correct heading hierarchy
- Proper form labels
- Keyboard accessibility
- Visible focus
- Sufficient contrast
- Meaningful link names
- Useful alt text
- Decorative images marked appropriately
- Accessible dialogs/menus
- Clear validation/error messages
- No keyboard traps
- Reduced-motion support
- Responsive zoom/reflow

Accessibility must be part of component design.

## SEO & Content Quality
For public pages:
- Semantic HTML
- Appropriate title/meta description
- Canonical URLs
- Clean slugs
- Open Graph/Twitter metadata
- Structured data when justified
- XML sitemap
- Appropriate robots directives
- Internal linking
- Heading hierarchy
- Optimized images
- Sound indexing/pagination strategy
- Avoid unnecessary duplicate content

Do not compromise accessibility for SEO.

## Performance
- Prevent N+1 queries.
- Optimize database access.
- Cache expensive stable data when appropriate.
- Use queues for slow/non-interactive work.
- Optimize and lazy-load images.
- Minimize unnecessary JavaScript.
- Split frontend code where useful.
- Avoid render-blocking assets.
- Paginate large datasets.
- Monitor slow queries.
- Use HTTP caching appropriately.
- Understand cache invalidation before adding caching.

## Testing Requirements

### Unit Tests
Cover business rules, services/actions, validation rules, transformations, and edge cases.

### Feature Tests
Cover:
- Authentication
- Authorization
- CRUD workflows
- Validation
- Public routes
- Admin routes
- IDOR/BOLA boundaries
- File uploads
- API behavior
- Rate limiting where important
- Transactional behavior
- Failure conditions

### Browser/UI Tests
Use browser-level tests for critical end-to-end flows where practical.

### Security Regression Tests
Every discovered security vulnerability or important security bug must have a regression test.

A happy-path test suite is not sufficient.

## Secure Development Workflow
Before changing code:
1. Inspect the existing architecture.
2. Read related routes, controllers, models, requests, policies, views, migrations, and tests.
3. Identify trust boundaries and authorization requirements.
4. Check privacy/security implications.
5. Reuse existing conventions.
6. Make the smallest coherent change.

After changing code:
1. Run formatting/static analysis as configured.
2. Run targeted tests.
3. Run relevant security/feature tests.
4. Review authorization.
5. Review database queries.
6. Review frontend accessibility and responsiveness.
7. Check logs/error behavior.
8. Check for secrets.
9. Check for regressions.
10. Update documentation when needed.

## AI Agent Operating Rules
Any coding agent working in this repository must:
- Inspect before editing.
- Never invent existing files, routes, APIs, columns, configuration, or framework behavior.
- Never overwrite unrelated work.
- Preserve conventions unless there is a strong reason to change them.
- Explain risky or breaking changes before applying them.
- Prefer incremental changes.
- Run tests after meaningful changes.
- Fix root causes instead of superficial workarounds.
- Never disable security controls to make tests pass.
- Never commit secrets.
- Never trust client-side validation alone.
- Never trust browser-supplied IDs or permissions.
- Avoid raw SQL when Eloquent/query builder is sufficient.
- Justify new dependencies and consider maintenance/security impact.
- Verify framework behavior from project documentation or official documentation when uncertain.
- Never claim a test passed unless it was actually executed.
- Never claim a vulnerability is fixed without verification.

When requirements are ambiguous, inspect project context first and choose the safest reversible interpretation available.

## Git & Change Management
Use focused commits with accurate commit messages.

Avoid mixing unrelated feature work, refactors, formatting-only changes, and dependency upgrades unless necessary.

Security-critical changes should be easy to review and trace.

Never commit secrets.

## Definition of Done
A task is complete only when:
- The implementation meets the requirement.
- Validation is present.
- Authorization is correct.
- Error handling is deliberate.
- Security controls remain intact.
- Tests cover important behavior.
- Accessibility is considered.
- Responsive behavior works.
- Frontend interactions work without console errors.
- Database changes have migrations.
- Performance implications are understood.
- No secrets are exposed.
- Documentation is updated where necessary.

For sensitive/security-critical changes, include explicit regression coverage.

## Production Security Checklist
- [ ] No secrets committed
- [ ] Production debug disabled
- [ ] HTTPS enforced
- [ ] Secure session cookies
- [ ] CSRF protection active for browser state changes
- [ ] Strong authorization and policies
- [ ] IDOR/BOLA regression tests
- [ ] Server-side validation
- [ ] XSS-safe output
- [ ] Parameterized DB access
- [ ] Mass-assignment protections
- [ ] Rate limiting on abuse-prone endpoints
- [ ] Secure file uploads
- [ ] Safe password hashing
- [ ] Session regeneration on authentication/privilege changes
- [ ] Sensitive data excluded from logs
- [ ] Controlled production errors
- [ ] Audit logs for important admin/security actions
- [ ] Security regression tests
- [ ] Dependencies reviewed and maintained
- [ ] Backup/restore procedures defined
- [ ] Transactions for atomic workflows
- [ ] Appropriate monitoring and alerting

## Final Engineering Rule
The standard is not “it works.”

The standard is:

**It works correctly, securely, accessibly, performantly, maintainably, and predictably under real-world use and failure conditions.**

When trade-offs are necessary, favor security, correctness, maintainability, and explicit engineering reasoning over shortcuts.
