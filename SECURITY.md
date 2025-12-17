# Security Policy

## Reporting a Vulnerability

If you discover a security vulnerability in this project, please report it privately. Do **not** create a public issue.

- Email: security@bangkah.dev (or your maintainer email)
- Or use GitHub's [private vulnerability reporting](https://docs.github.com/en/code-security/security-advisories/guidance-on-reporting-and-writing/privately-reporting-a-security-vulnerability)

We will respond as soon as possible and coordinate a fix.

## Supported Versions
| Version | Supported          |
| ------- | ----------------- |
| 1.x     | :white_check_mark:|
| < 1.0   | :x:               |

## Responsible Disclosure
We appreciate responsible disclosure. Please give us time to patch before public disclosure.

## Dependabot Alerts
This repository uses [Dependabot](https://github.com/dependabot) for automated dependency security updates. If you do not see alerts, ensure you have enabled security updates in the repository settings.

## CLI Code Generation Risk
Bangkah CLI can generate code from templates. Malicious templates can inject backdoors. Only use trusted templates and review generated code before deploying to production.

---

For more information, see [GitHub Security Best Practices](https://docs.github.com/en/code-security/getting-started/securing-your-repository).
