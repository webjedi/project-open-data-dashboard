#Documentation

This is a guide to document how this website measures and tracks implementation of [Project Open Data](http://project-open-data.github.com/) as well as other tools and resources it provides to help agencies implement their open data programs. 

You can help [edit this documentation on GitHub](https://github.com/GSA/project-open-data-dashboard/edit/master/documentation/main.md). 

##Agency Dashboard

The [Agency Dashboard](http://labs.data.gov/dashboard/offices) is used to track how agencies are implementing [Project Open Data](http://project-open-data.github.com/) (aka [OMB M-13-13](http://project-open-data.github.io/policy-memo/)). This is done in two ways: 

1. Review of the [leading indicators](#leading_indicators) (detailed below) by OMB staff
2. [Automated metrics](#automated_metrics) that analyze machine readable files (eg, data.json, digitalstrategy.json)

The leading indicators are scored by OMB staff and they can involve a more subjective evaluation process. The indicators are also informed by the automated metrics which are generated by a daily automated script that analyzes files on agency websites to understand the progress and current status of their public data listings.

###Milestones

The dashboard is oriented around quarterly milestones. You can use  the blue milestone selection menu to navigate between milestones. The OMB scoring as well as the automated metrics are always tied to a specific milestone. The automated metrics will update every 24 hours until the end of the quarter when the milestone has been reached. At that point those automated metrics will represent a historical snapshot. To see the most current automated metrics, you'll need to view the current quarter (the next approaching milestone).

<span id="leading_indicators_strategy"></span>
###Leading Indicators Strategy

The "Leading Indicators Strategy" refers to the five categories of indicators drawn from the [Cross Agency Priority Goals (CAP Goals) for Open Data](http://www.performance.gov/node/3396?view=public#overview). The strategies are based on the [Enterprise Data Inventory](#enterprise_data_inventory), the [Public Data Listing](#public_data_listing), [Public Engagement](#public_engagement), [Privacy & Security](#privacy_and_security), and [Human Capital](#human_capital) and are all detailed below. 


<span id="leading_indicators"></span>
###Leading Indicators

The Leading Indicators Strategies described above are broken down here into their component parts: 

---

<span id="enterprise_data_inventory"></span>
####Enterprise Data Inventory

<span id="edi_aggregate_score"></span>
#####Overall Progress this Milestone
No documentation added yet 

<span id="edi_updated"></span>
#####Inventory Updated this Quarter
No documentation added yet 

<span id="edi_datasets"></span>
#####Number of Datasets
No documentation added yet 

<span id="edi_schedule_delivered"></span>
#####Schedule Delivered
No documentation added yet 

<span id="edi_bureaus"></span>
#####Bureaus represented
No documentation added yet 

<span id="edi_programs"></span>
#####Programs represented
No documentation added yet 

<span id="edi_access_public"></span>
#####Access Level = Public
No documentation added yet 

<span id="edi_access_restricted"></span>
#####Access Level = Restricted
No documentation added yet 

<span id="edi_access_nonpublic"></span>
#####Access Level = Non-Public
No documentation added yet 

<span id="edi_superset"></span>
#####Inventory > Public listing
No documentation added yet 

<span id="edi_progress_evaluation"></span>
#####Percentage growth in records since last quarter
No documentation added yet 

<span id="edi_schedule_risk"></span>
#####Schedule Risk for Nov 30, 2014
No documentation added yet 

<span id="edi_quality_check"></span>
#####Spot Check - Site search, SORNs, PIAs, FOIA
No documentation added yet 


---

<span id="public_data_listing"></span>
####Public Data Listing

<span id="pdl_aggregate_score"></span>
#####Overall Progress this Milestone
No documentation added yet 

<span id="pdl_datasets"></span>
#####Number of Datasets
No documentation added yet 

<span id="pdl_downloadable"></span>
#####Number of Downloadable Datasets
No documentation added yet 

<span id="pdl_growth"></span>
#####Percentage growth in records since last quarter
No documentation added yet 

<span id="pdl_valid_metadata"></span>
#####Valid Metadata
See the section for [Valid Schema](#datajson_valid_schema)

<span id="pdl_slashdata"></span>
#####/data
No documentation added yet 

<span id="pdl_datajson"></span>
#####/data.json
No documentation added yet 

<span id="pdl_datagov_harvested"></span>
#####Harvested by data.gov
No documentation added yet 

---

<span id="public_engagement"></span>
####Public Engagement

<span id="pe_aggregate_score"></span>
#####Overall Progress this Milestone
No documentation added yet 

<span id="pe_feedback_specified"></span>
#####Description of feedback mechanism delivered
No documentation added yet 

<span id="pe_prioritization"></span>
#####Data release is prioritized through public engagement
No documentation added yet 

<span id="pe_dialogue"></span>
#####Feedback loop is closed, 2 way communication
No documentation added yet 

<span id="pe_reference"></span>
#####Link to or description of Feedback Mechanism
No documentation added yet 

---

<span id="privacy_and_security"></span>
####Privacy & Security

<span id="ps_aggregate_score"></span>
#####Overall Progress this Milestone
No documentation added yet 

<span id="ps_publication_process"></span>
#####Data Publication Process Delivered
No documentation added yet 

<span id="ps_publication_process_qa"></span>
#####Information that should not to be made public is documented with agency's OGC
No documentation added yet 

---

<span id="human_capital"></span>
####Human Capital

<span id="hc_aggregate_score"></span>
#####Overall Progress this Milestone
No documentation added yet 

<span id="hc_lead"></span>
#####Open Data Primary Point of Contact
No documentation added yet 

<span id="hc_contacts"></span>
#####POCs identified for required responsibilities
No documentation added yet 

---

<span id="automated_metrics"></span>
###Automated Metrics
These fields are determined by an automated script that analyzes agency data.json, digitalstrategy.json, and /data files. 

The automated metrics will update every 24 hours until the end of the quarter when a milestone has been reached. At that point those metrics will represent a historical snapshot. To see the most current automated metrics, you'll need to view the current quarter (the next approaching milestone).

<span id="datajson_expected_url"></span>
####Expected URL

This is the URL where the data.json file is expected to be found. This is based on the main agency URL provided through the [USA.gov Directory API](http://www.usa.gov/About/developer-resources/federal-agency-directory/)

<span id="datajson_resolved_url"></span>
####Resolved URL

This is the URL that is resolved after following any redirects.

<span id="datajson_redirects"></span>
####Redirects

This is the number of redirects used to reach the final data.json URL. Currently this is only set to follow 5 redirects before stopping.

Ideally this should be 0

<span id="datajson_http_status"></span>
####HTTP Status

This is the [HTTP status code](http://en.wikipedia.org/wiki/HTTP_status_codes) received when attempting to reach the expected or resolved URL. For more information on properly using HTTP status codes, see: [Knowing Your HTTP Status Codes In Federal Government](http://kinlane.com/2013/11/06/knowing-your-http-status-codes-in-federal-government/)

This should be 200 it the data.json or /data URL was found successfully.

<span id="datajson_content_type"></span>
####Content-Type

The [Content-Type](http://en.wikipedia.org/wiki/Content-Type) is how the server announces the type of file it is serving at the requested URL. Usually it won't break anything if this is set incorrectly, but some applications may need to be set to force it to be read as JSON even if it announces it's something else. This is very similiar to how a file extension on a file identifies the file type. Yes, the URL says data.json, but the browser just sees that as an arbitrary URL. The Content-Type is what identifies the actual file type. Setting this incorrectly would be like if you had a file named graph.pdf that was actually a CSV spreadsheet file.

The [character encoding](http://en.wikipedia.org/wiki/Character_encoding) should also be specified as part of the Content-Type. This encoding should match the actual encoding of the text in the file. The correct character encoding for [JSON](http://json.org/) is always unicode, preferably [UTF-8](http://en.wikipedia.org/wiki/Utf-8).

For data.json this should be: `application/json; charset=utf-8`

For /data this should be: `text/html; charset=utf-8`

<span id="datajson_valid_json"></span>
####Valid JSON

This identifies whether the data.json was actually [JSON](http://json.org/). Even if the HTTP Status is 200 for the data.json URL and the Content-Type announces it's application/json; charset=UTF-8 the response might actually be HTML or improperly formatted JSON. If the syntax of the file can be parsed as JSON, the validator will attempt to do additional analysis, but the file may in fact still be invalid JSON if it doesn't use the proper text encoding. While it is possible for the validator to convert the file to the correct encoding to do this additional analysis, it's important that the correct encoding be used at the source so that others will be able to parse the JSON without knowing they need to convert it to a valid encoding. JSON must use Unicode text encoding (use UTF-8) and it should not include a byte order mark. It's highly recommend you generate your JSON with a tool designed to produce JSON rather than attempt to produce JSON by hand. You can check how well formed your JSON is with a tool like [JSONLint](http://jsonlint.com/). When using this tool it is best to enter the URL of the JSON file rather than copying and pasting the JSON. This is because when you copy and paste the raw JSON, your browser may attempt ot automtically fix problems that the server will not know to fix when it retrieves the file directly.

The "Public Datasets" column on the main agency dashboard table will be green if it's a valid JSON file and red or yellow otherwise. If it's not a valid JSON file, the "Valid Metadata" column can't be green - at best it can be yellow. If it's not valid JSON it most likely can't be parsed regardless of how valid the metadata schema is, so this is a serious consideration. This also means it's possible to be listed under the "Valid Metadata" column in yellow even if 100% of the records validate against the schema. 

<span id="datajson_valid_count"></span>
####Datasets with Valid Metadata
The percentage and specific number of datasets in the data.json file that successfully validate against the [Project Open Data schema](http://project-open-data.github.io/schema/). 

The "Valid Metadata" column on the main agency dashboard table will be green if 100% of the metadata records validate against the Project Open Data schema and they are from a [valid JSON file](#datajson_valid_json). It's possible to have 100% valid metadata records but still be shown as yellow if it's not a valid JSON file. Any record that doesn't validate against the schema won't meet the requirements and also won't be included by harvesters like data.gov. 

<span id="datajson_valid_schema"></span>
####Valid Schema

This identifies whether the data.json has all the required fields and has values that fit within the parameters specified by the [Project Open Data schema](http://project-open-data.github.io/schema/). 

<span id="datajson_schema_errors"></span>
#####Schema Errors
This displays instances where the data.json doesn't validate against the [Project Open Data schema](http://project-open-data.github.io/schema/) based on rules codified within a [JSON Schema document](https://github.com/project-open-data/project-open-data.github.io/tree/master/schema/1_0_final) hosted on Project Open Data. For more detailed and more readable results, you should use the [Project Open Data validator](http://labs.data.gov/dashboard/validate)

<span id="datajson_file_size"></span>
#####Data.json File Size
The size of the data.json file the last time it was checked by the validator (for the selected milestone)

<span id="datajson_last_modified"></span>
#####Data.json Last Modified
The last time the data.json file appears to have been updated (for the selected milestone)

<span id="datajson_last_crawl"></span>
#####Data.json Last Crawl
The last time this validator analyzed the data.json file

