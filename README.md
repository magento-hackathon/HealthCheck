HealthCheck
===========

The extension helps to discover configuration and technical issues within a magento installation. It's target group are developers.


## Basic Architecture

The HealthCheck provides the developer with internal information about technical issues. It implements a plugin architecture that makes it easy to execute included default checks or even create new checks. 
The checks can be executed in Magento backend, by cron, or even via web service.


## Test Plugins

Each check is build in an own plugin, which is simply a model class extending the abstract class *Hackathon_HealthCheck_Model_Check_Abstract*. Additionally it is configured in *config.xml* as described in detail below.

### Check Types

Each check can work in two basic ways:
* static: The test is directly executed on opening backend tool (used for quick tasks)
* ondemand: The test is executed on demand when user hits "execute" button (used for long-running tasks)

```xml
<type>static</type>
```

### Content Types

The plugin must return the check result as one of the following content-types configured in config.xml

* plaintext
* piechart 
* barchart 
* donutchart
* table

```xml
<content-type>true</content-type>
``` 


### Supported Magento Versions

For each plugin the supported Magento versions can be configured

```xml
<versions>
  <version>1.5</version>
  <version>1.6</version>
  <version>1.7.0.2</version>
  <version>1.8.0</version>
</versions>
```

### Example (sitemap check)

```xml
<config>
    <global>
        <healthcheck>
            <sitemap> <!-- name of the check -->
                <model>hackathon_healthcheck/check_sitemap</model> <!-- used model class -->
                <active>true</active> <!-- activation of this plugin (true|false) -->
                <type>static</type> <!-- execution type (static|ondemand) -->
                <content-type>plaintext</content-type> <!-- content type of the plugin result -->
                <versions> <!-- supported magento versions (optional) -->
                    <version>1.5</version> <!-- all 1.5 versions -->
                    <version>1.6</version> <!-- all 1.6 versions -->
                    <version>1.7.0.2</version> <!-- only exactly 1.7.0.2 -->
                    <version>1.8.0</version> <!-- all 1.8.0.* versions -->
                </versions>
            </sitemap>
        </healthcheck>
    </global>
</config>
```

## Backend Usage

???


## Howto: Developing an own Test Plugin

???
