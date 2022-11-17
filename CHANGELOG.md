# Changelog

All notable changes to `laravel-mfa` will be documented in this file.

## v0.1.6 - 2022-11-17

### Added
- Add exception handling for Twilio errors ([#11](https://github.com/worksome/laravel-mfa/pull/11))

## v0.1.5 - 2022-10-24

### Changed
- Use the cache contract instead of the concrete class ([#9](https://github.com/worksome/laravel-mfa/pull/9))
- Use an early return for cleaner code ([#10](https://github.com/worksome/laravel-mfa/pull/10))

## v0.1.4 - 2022-10-19

### Fixed
- Resolve null drivers when config is set to `null` literal ([#8](https://github.com/worksome/laravel-mfa/pull/8))

## v0.1.3 - 2022-10-18

### Fixed
- Use Form request for Twilio Verify ([#7](https://github.com/worksome/laravel-mfa/pull/7))

## v0.1.2 - 2022-10-18

### Fixed
- Update typo of `services` to `drivers` in managers ([#6](https://github.com/worksome/laravel-mfa/pull/6))

## v0.1.1 - 2022-09-21

### Fixed
- Ensure minimum of 8 characters in TOTP secret ([56e7f19](https://github.com/worksome/laravel-mfa/commit/56e7f19a409fde8556253c6e362d1fcb599174d7))
- Add `$data` property to abstract `Identifier` class ([5cab045](https://github.com/worksome/laravel-mfa/commit/5cab045677848417fd028068bf3e36760a58720d))

## v0.1.0 - 2022-09-21

### Added
- Initial release
