# sw5-scn-subresource-integrity
Plugin for Shopware 5 providing [Subresource Integrity](https://developer.mozilla.org/en-US/docs/Web/Security/Subresource_Integrity) for resources.

## Installation
```bash
cd <instance>/engine/Shopware/Plugins/Community/Frontend
git clone https://github.com/screeny05/sw5-scn-subresource-integrity ScnSubresourceIntegrity
```

Then procede to install the plugin via backend and configure it to your likings.

## Usage
This plugin provides an additional smarty-function which can be called via
```
{sri file=<path relative to docroot>}
```

#### Additional Parameters:
Appart from the file-param you can provide the following:
* `assign`: instead of echoing, the return-value will be assigned to a variable.
* `algorithm`: takes a string which gets accepted by the `hash()`-function. Use `hash_algos()` to get a list of all available algorithms.

Here's a note from the W3C on [supported algorithms](https://www.w3.org/TR/SRI/#cryptographic-hash-functions):
> Conformant user agents must support the SHA-256, SHA-384 and SHA-512 cryptographic hash functions for use as part of a request’s integrity metadata and **may support additional hash functions**.
