[![phpBB](https://www.phpbb.com/theme/images/logos/blue/160x52.png)](http://www.phpbb.com)

# [3.2][RC] Search Back Extension 1.0.1
Search topics which were created or answered in the last 15, 30 or 45 minutes; 1, 2, 6 or 12 hours; 1, 3, 7, 10, 15 or 20 days; 1 month (easily expandable to other values) from the event and language pages.

## Requirements:
* phpBB >= 3.1.0-RC2
* PHP >= 5.3.3

## Install
1. Download the latest release.
2. In the `ext` directory of your phpBB board, copy the `Picaron/SearchBack` folder. It must be so: `/ext/Picaron/SearchBack`
3. Navigate in the ACP to `Customise -> Manage extensions`.
4. Look for `Search Back Extension` under the Disabled Extensions list, and click its `Enable` link.
5. Configure by navigating in the ACP -> GENERAL -> Post Setting -> Extension: `Search Back`

## Uninstall
1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `Search Back Extension` under the Enabled Extensions list, and click its `Disable` link.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/Picaron/SearchBack` folder.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)
