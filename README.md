# Craft CMS AWS serverless image handler

Generates image handle from inside twig for AWS serverless image handler. [More info](https://aws.amazon.com/solutions/serverless-image-handler/)
Automatically detects client webp support.

![Flow](https://github.com/dutchheight/aws-serverless-image-handler/blob/master/resources/img/serverless.png "Flow")

## Requirements

- This plugin requires Craft CMS 3.0.0-beta.23 or later.
- A working S3 volume is required. Use [Craft AWS S3](https://github.com/craftcms/aws-s3).
- A working cloudformation stack [For more info an instuctions](https://aws.amazon.com/solutions/serverless-image-handler/). (Instructions comming soon)

## Installation

### S3

1. Install S3 volume plugin Use [Craft AWS S3](https://github.com/craftcms/aws-s3).

2. Create a volume with the following settings:
    - `Base URL` is your cloudfront url (*.cloudfront.net)
    - `Access Key ID` is your IAM ID
    - `Secret Access key` is your IAM secret key
    - `Bucket name` is the name of your S3 bucket
    - `Bucket region` the region for exaple us-east-1
    - `Make Uploads Public` false
    - `Focal point` false

### AWS serverless image handler
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

If you load the image with `asset.url` the original source will be served.

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

## Extra information
For more info about AWS serverless image handler and other ways to use AWS SIH with Craft CMS take a look at:
[Setting up your own image transform service](https://nystudio107.com/blog/setting-up-your-own-image-transform-service)

## License
[Craft](https://craftcms.github.io/license/)
