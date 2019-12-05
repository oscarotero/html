# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [0.1.5] - 2019-12-05
### Added
- New `raw()` function to add raw unescaped html.

## [0.1.4] - 2019-12-01
### Fixed
- The elements `area`, `track`, `embed`, `param`, `source` and `col` are [empty elements](https://developer.mozilla.org/en-US/docs/Glossary/empty_element) so they should use the `SelfClosingElement` class.
- Code style improvements

## [0.1.3] - 2019-06-15
### Fixed
- Fixed `<style>` and `<script>` elements that should not escape the strings.

## [0.1.2] - 2019-05-04
### Fixed
- Fixed a bug on create a self closing element with an array of attributes: `input(['type' => 'text'])`.

## [0.1.1] - 2019-05-02
### Fixed
- Add support for `null` values as children
- Escape special characters to HTML entities using [htmlspecialchars](https://php.net/htmlspecialchars)

## 0.1.0 - 2019-04-27
First version

[0.1.5]: https://github.com/oscarotero/html/compare/v0.1.4...v0.1.5
[0.1.4]: https://github.com/oscarotero/html/compare/v0.1.3...v0.1.4
[0.1.3]: https://github.com/oscarotero/html/compare/v0.1.2...v0.1.3
[0.1.2]: https://github.com/oscarotero/html/compare/v0.1.1...v0.1.2
[0.1.1]: https://github.com/oscarotero/html/compare/v0.1.0...v0.1.1
