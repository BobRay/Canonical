
Canonical


Author: Bob Ray <https://bobsguides.com>
Copyright 2010-2022 Bob Ray

The Canonical snippet puts a canonical tag in the &lt;head&gt; section of your template. The tag's purpose is to make sure that search engines will not penalized you for duplicate content.

As of Version 3.0.0-pl, the default behavior is to put a canonical tag on every page, as recommended by SEO experts, and reportedly confirmed by Google as a best practice.

Put the following tag in the &lt;head&gt; section of all templates:

    [[!Canonical]]

or, if you don't want a tag on every page:

    [[!Canonical? &canonical_always=`0`]]

The exclamation point above is critical, leaving it out will cause search engines to hate your site.

See the Official Documentation at https://bobsguides.com/canonical-tutorial.html for more details.

Bugs and Feature Requests: https://github.com/BobRay/Canonical/issues

Questions: https://community.modx.com

Created by MyComponent
