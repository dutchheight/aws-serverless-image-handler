# Craft CMS AWS serverless image handler

Generates base64 url to request images from AWS serverless image handler solution. [More info](https://aws.amazon.com/solutions/serverless-image-handler/)
Automatically detects client webp support.


## Requirements

- This plugin requires Craft CMS 3.0.0-beta.23 or later.
- A working S3 volume is required. Use [Craft AWS S3](https://github.com/craftcms/aws-s3).
- A working cloudformation stack [For more info an instuctions](https://aws.amazon.com/solutions/serverless-image-handler/).

## Installation

After setting up the S3 volume follow these instructions to install the plugin.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require dutchheight/aws-serverless-image-handler

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for AWS Serverless Image Handler.

4. Add `Toggle aws image processor` to your s3 volume field layout.

## Usage

In your twig template you can use:
``` twig
{% set settings = {
    width: 2600,
    height: 450
} %}
    
{{ craft.awsserverlessimagehandler.getImgUrl(entry.slider.one(), settings) }}

```

This will generate the propper URL for the asset. 

### Availible settings
| Properties | Values | Default |
|------------|--------|---------|
|width       |`px`                                        |`800px`      |
|height      |`px`                                        |`400px`      |
|fit         |`cover`, `contain`, `fill`, `inside` or `outside`   |`cover`      |
|position    |`top`, `right top`, `right`, `right bottom`, `bottom`, `left bottom`, `left` or `left top`   |`focalpoint`|

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
Please make sure to update tests as appropriate.

## License
[Craft](https://craftcms.github.io/license/)