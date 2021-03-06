<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class campaign_model extends CI_Model {


	//var $pagination	 		= NULL;
	var $jurisdictions 		= array();


	var $protected_field	= null;


	public function __construct(){
		parent::__construct();

		$this->load->helper('api');


		// Determine the environment we're run from for debugging/output
		if (php_sapi_name() == 'cli') {
			if (isset($_SERVER['TERM'])) {
				$this->environment = 'terminal';
			} else {
				$this->environment = 'cron';
			}
		} else {
			$this->environment = 'server';
		}

		//$this->office					= $this->office();

	}

	public function datagov_office($office_id, $milestone = null) {

		$this->db->select('*');
		$this->db->where('office_id', $office_id);

		if($milestone) $this->db->where('milestone', $milestone);

		$query = $this->db->get('datagov_campaign');

		if ($query->num_rows() > 0) {
		   return $query->row();
		} else {
		   return false;
		}

	}


	public function datagov_model() {

		$model = new stdClass();

		$model->office_id						= null;
		$model->milestone						= null;
		$model->contact_name					= null;
		$model->contact_email					= null;
		$model->datajson_status					= null;
		$model->datapage_status					= null;
		$model->digitalstrategy_status			= null;

		$model->tracker_fields					= '';
		$model->tracker_status					= null;

		return $model;
	}


	public function tracker_model() {

		$model = new stdClass();
		$field = new stdClass();

		$field->type 								= null;
		$field->value								= null;
		$field->label								= null;
		$field->placeholder							= null;


		// Enterprise Data Inventory

		$model->edi_aggregate_score					= clone $field;
		$model->edi_aggregate_score->label 			= "Overall Progress this Milestone";
		$model->edi_aggregate_score->type 			= "traffic";

		$model->edi_updated							= clone $field;
		$model->edi_updated->label 					= "Inventory Updated this Quarter";
		$model->edi_updated->type 					= "select";

		$model->edi_datasets						= clone $field;
		$model->edi_datasets->label 				= "Number of Datasets";
		$model->edi_datasets->type 					= "string";

		$model->edi_schedule_delivered				= clone $field;
		$model->edi_schedule_delivered->label 		= "Schedule Delivered";
		$model->edi_schedule_delivered->type 		= "select";

		$model->edi_bureaus							= clone $field;
		$model->edi_bureaus->label 					= "Bureaus represented";
		$model->edi_bureaus->type 					= "string";

		$model->edi_programs						= clone $field;
		$model->edi_programs->label 				= "Programs represented";
		$model->edi_programs->type 					= "string";

		$model->edi_access_public					= clone $field;
		$model->edi_access_public->label 			= "Access Level = Public";
		$model->edi_access_public->type 			= "string";

		$model->edi_access_restricted				= clone $field;
		$model->edi_access_restricted->label 		= "Access Level = Restricted";
		$model->edi_access_restricted->type 		= "string";

		$model->edi_access_nonpublic				= clone $field;
		$model->edi_access_nonpublic->label 		= "Access Level = Non-Public";
		$model->edi_access_nonpublic->type 			= "string";

		$model->edi_superset						= clone $field;
		$model->edi_superset->label 				= "Inventory > Public listing";
		$model->edi_superset->type 					= "select";

		$model->edi_progress_evaluation				= clone $field;
		$model->edi_progress_evaluation->label 		= "Percentage growth in records since last quarter";
		$model->edi_progress_evaluation->type 		= "string";

		$model->edi_schedule_risk					= clone $field;
		$model->edi_schedule_risk->label 			= "Schedule Risk for Nov 30, 2014";
		$model->edi_schedule_risk->type 			= "traffic";

		// $model->edi_confidence_assessment			= clone $field;
		// $model->edi_confidence_assessment->label	= "OMB Confidence Assesment";
		// $model->edi_confidence_assessment->type 	= "string";

		$model->edi_quality_check					= clone $field;
		$model->edi_quality_check->label 			= "Spot Check - Site search, SORNs, PIAs, FOIA";
		$model->edi_quality_check->type 			= "string";


		// Public Data Listing

		$model->pdl_aggregate_score					= clone $field;
		$model->pdl_aggregate_score->label 			= "Overall Progress this Milestone";
		$model->pdl_aggregate_score->type 			= "traffic";

		$model->pdl_datasets						= clone $field;
		$model->pdl_datasets->label 				= "Number of Datasets";
		$model->pdl_datasets->type 					= "string";

		$model->pdl_downloadable					= clone $field;
		$model->pdl_downloadable->label 			= "Number of Downloadable Datasets";
		$model->pdl_downloadable->type 				= "string";


		$model->pdl_growth							= clone $field;
		$model->pdl_growth->label 					= "Percentage growth in records since last quarter";
		$model->pdl_growth->type 					= "string";


		$model->pdl_valid_metadata					= clone $field;
		$model->pdl_valid_metadata->label 			= "Valid Metadata";
		$model->pdl_valid_metadata->type 			= "string";

		$model->pdl_slashdata						= clone $field;
		$model->pdl_slashdata->label 				= "/data";
		$model->pdl_slashdata->type 				= "select";

		$model->pdl_datajson						= clone $field;
		$model->pdl_datajson->label 				= "/data.json";
		$model->pdl_datajson->type 					= "select";

		$model->pdl_datagov_harvested				= clone $field;
		$model->pdl_datagov_harvested->label 		= "Harvested by data.gov";
		$model->pdl_datagov_harvested->type 		= "select";



		// Public Engagement

		$model->pe_aggregate_score					= clone $field;
		$model->pe_aggregate_score->label 			= "Overall Progress this Milestone";
		$model->pe_aggregate_score->type 			= "traffic";

		$model->pe_feedback_specified				= clone $field;
		$model->pe_feedback_specified->label 		= "Description of feedback mechanism delivered";
		$model->pe_feedback_specified->type 		= "select";

		$model->pe_prioritization					= clone $field;
		$model->pe_prioritization->label 			= "Data release is prioritized through public engagement";
		$model->pe_prioritization->type 			= "traffic";

		$model->pe_dialogue							= clone $field;
		$model->pe_dialogue->label 					= "Feedback loop is closed, 2 way communication";
		$model->pe_dialogue->type 					= "traffic";

		//$model->pe_impact							= clone $field;
		//$model->pe_impact->label 					= "Feedback leads to change in data management and release practices";
		//$model->pe_impact->type 					= "traffic";

		$model->pe_reference						= clone $field;
		$model->pe_reference->label 				= "Link to or description of Feedback Mechanism";
		$model->pe_reference->type 					= "string";


		// Privacy & Security

		$model->ps_aggregate_score					= clone $field;
		$model->ps_aggregate_score->label 			= "Overall Progress this Milestone";
		$model->ps_aggregate_score->type 			= "traffic";

		$model->ps_publication_process				= clone $field;
		$model->ps_publication_process->label 		= "Data Publication Process Delivered";
		$model->ps_publication_process->type 		= "traffic";

		$model->ps_publication_process_qa			= clone $field;
		$model->ps_publication_process_qa->label 	= "Information that should not to be made public is documented with agency's OGC";
		$model->ps_publication_process_qa->type 	= "traffic";


		// Human Capital

		$model->hc_aggregate_score					= clone $field;
		$model->hc_aggregate_score->label 			= "Overall Progress this Milestone";
		$model->hc_aggregate_score->type 			= "traffic";

		$model->hc_lead								= clone $field;
		$model->hc_lead->label 						= "Open Data Primary Point of Contact";
		$model->hc_lead->type 						= "string";

		$model->hc_contacts							= clone $field;
		$model->hc_contacts->label 					= "POCs identified for required responsibilities";
		$model->hc_contacts->type 					= "traffic";

		return $model;
}



	public function tracker_sections_model() {

        $section_breakdown = array(
                                    "edi" => "Enterprise Data Inventory", 
                                    "pdl" => "Public Data Listing", 
                                    "pe" => "Public Engagement", 
                                    "ps" => "Privacy &amp; Security", 
                                    "hc" => "Human Capital"
                                );  

        return $section_breakdown;

	}


	public function tracker_review_model() {

		$model = new stdClass();

		$model->status 						= null;
		$model->reviewer_name				= null;
		$model->reviewer_email				= null;
		$model->last_updated				= null;
		$model->last_editor					= null;

		return $model;

	}


	public function milestones_model() {

		$milestones = array(
							"2013-11-30" => "Milestone 1",
							"2014-02-28" => "Milestone 2",
							"2014-05-31" => "Milestone 3",
							"2014-08-31" => "Milestone 4",
							"2014-11-30" => "Milestone 5",
							"2015-02-28" => "Milestone 6"
							);

		return $milestones;
	}


	public function milestone_filter($selected_milestone, $milestones) {

		// Sets the first milestone in the future as the current and last available milestone
	    foreach ($milestones as $milestone_date => $milestone) {
	        if (strtotime($milestone_date) > time()) {
	            
	        	if(empty($current_milestone)) {
	        		$current_milestone = $milestone_date;	
	        	} else {
	        		unset($milestones[$milestone_date]);
	        	}	            
	        } 
	    }

	    // if we didn't explicitly select a milestone, use the current one
		if(empty($selected_milestone)) {
			$selected_milestone = $current_milestone;
			$specified = "false";			
		} else {
			$specified = "true";
		}

		reset($milestones);

		// determine previous milestone
		while (key($milestones) !== $current_milestone) next($milestones);
		prev($milestones);
		$previous_milestone = key($milestones);

		reset($milestones);

		$response = new stdClass();

		$response->selected_milestone 	= $selected_milestone;
		$response->current 				= $current_milestone;
		$response->previous 			= $previous_milestone;
		$response->specified			= $specified;

		$response->milestones 			= $milestones;

		return $response;

	}



	public function note_model() {

		$model = new stdClass();

		$model->date							= null;
		$model->author							= null;
		$model->note							= null;
		$model->note_html						= null;

		$note = new stdClass();

		$note->current							= $model;

		return $note;
	}








	public function datajson_crawl() {

		$model = new stdClass();

		$model->id 					= null;
		$model->office_id 			= null;
		$model->datajson_url 		= null;
		$model->crawl_cycle 		= null;
		$model->crawl_status 		= null;
		$model->start 				= null;
		$model->end 				= null;

		return $model;
	}


	public function metadata_record() {

		$model = new stdClass();

		$model->id 						= null;
		$model->office_id 				= null;
		$model->datajson_url 			= null;
		$model->identifier 				= null;
		$model->json_body 				= null;
		$model->schema_valid 			= null;
		$model->validation_errors 		= null;
		$model->last_modified_header 	= null;
		$model->last_modified_body 		= null;
		$model->last_crawled 			= null;
		$model->crawl_cycle 			= null;

		return $model;
	}



	public function metadata_resource() {

		$model = new stdClass();

		$model->id                         = null;
 		$model->metadata_record_id         = null;
 		$model->metadata_record_identifier = null;
 		$model->url                        = null;

		return $model;
	}








	public function uri_header($url, $redirect_count = 0) {

		$status = curl_header($url);
		$status = $status['info'];	//content_type and http_code

		if($status['redirect_count'] == 0 && !(empty($redirect_count))) $status['redirect_count'] = 1;
		$status['redirect_count'] = $status['redirect_count'] + $redirect_count;

		if(!empty($status['redirect_url'])) {
			if($status['redirect_count'] == 0 && $redirect_count == 0) $status['redirect_count'] = 1;

			if ($status['redirect_count'] > 5) return $status;
			$status = $this->uri_header($status['redirect_url'], $status['redirect_count']);
		}

		if(!empty($status)) {
			return $status;
		} else {
			return false;
		}
	}


	public function validate_datajson_old($uri) {

		$this->load->helper('jsonschema');

		$schema = json_decode(file_get_contents(realpath('./schema/catalog.json')));

		if($data = @file_get_contents($uri)) {
    		$data = json_decode($data);

    		if(!empty($data)) {
    			return Jsv4::validate($data, $schema);
    		} else {
    			return false;
    		}
		} else {
		    return false;
		}
	}

	public function validate_datajson($datajson_url = null, $datajson = null, $headers = null, $schema = null, $return_source = false, $quality = false) {


		if ($datajson_url) {

			$datajson_header = ($headers) ? $headers : $this->campaign->uri_header($datajson_url);

			$errors = array();

			// Max file size
			$max_remote_size = $this->config->item('max_remote_size');


			// Only download the data.json if we need to
			if(empty($datajson_header['download_content_length']) || 
				$datajson_header['download_content_length'] < 0 || 
				(!empty($datajson_header['download_content_length']) && 
				$datajson_header['download_content_length'] > 0 && 
				$datajson_header['download_content_length'] < $max_remote_size)) {

				// Load the JSON
				$opts = array(
							  'http'=>array(
							    'method'=>"GET",
							    'user_agent'=>"Data.gov data.json crawler"
							  )
							);

				$context = stream_context_create($opts);
				
				$datajson = @file_get_contents($datajson_url, false, $context);

				if ($datajson == false) {

					$datajson = curl_from_json($datajson_url, false, false);

					if(!$datajson) {
						$errors[] = "File not found or couldn't be downloaded";	
					}
					
				} 

			}


			if(!empty($datajson) && (empty($datajson_header['download_content_length']) || $datajson_header['download_content_length'] < 0)) {
				$datajson_header['download_content_length'] = strlen($datajson);
			}

			// See if it exceeds max size
			if($datajson_header['download_content_length'] > $max_remote_size) {

				$filesize = human_filesize($datajson_header['download_content_length']);
				$errors[] = "The data.json file is " . $filesize . " which is currently too large to parse with this tool. Sorry.";

			}

			// See if it's valid JSON 
			if(!empty($datajson) && $datajson_header['download_content_length'] < $max_remote_size) {

				// See if raw file is valid
				$raw_valid_json = is_json($datajson);

				// See if we can clean up the file to make it valid
				if(!$raw_valid_json) {
					$datajson_processed = json_text_filter($datajson);
					$valid_json 		= is_json($datajson_processed);
				} else {
					$valid_json = true;
				}

				if ($valid_json !== true) {
					$errors[] = 'The validator was unable to determine if this was valid JSON';
				}				
			}

			if(!empty($errors)) {

				$valid_json 	= (isset($valid_json)) ? $valid_json : null;
				$raw_valid_json = (isset($raw_valid_json)) ? $raw_valid_json : null;

				$response = array(
								'raw_valid_json' => $raw_valid_json,
								'valid_json' => $valid_json, 
								'valid' => false, 
								'fail' => $errors, 
								'download_content_length' => $datajson_header['download_content_length']
								);


				if($valid_json && $return_source === false) {
					$catalog = json_decode($datajson_processed);
					$response['total_records'] = count($catalog);
				}

				return $response;
			}

		}


		// filter string for json conversion if we haven't already
		if ($datajson && empty($datajson_processed)) {
			$datajson_processed = json_text_filter($datajson);
		}


		// verify it's valid json
		if($datajson_processed) {
			if(!isset($valid_json)) {
				$valid_json = is_json($datajson_processed);
			}
		}


		if ($datajson_processed && $valid_json) {

			$chunk_size = 500;

			$datajson_decode = json_decode($datajson_processed);
			$datajson_chunks = array_chunk($datajson_decode, $chunk_size);			

			$response = array();
			$response['errors'] = array();

			if($quality == true) {
				$response['qa'] = array();
			}

			foreach ($datajson_chunks as $chunk_count => $chunk) {

				$chunk = json_encode($chunk);
				$validator = $this->campaign->jsonschema_validator($chunk, $schema);

				if(!empty($validator['errors']) ) {

					if ($chunk_count) {
						$key_offset = $chunk_size * $chunk_count;
						$key_offset = $key_offset;
					} else {
						$key_offset = 0;
					}

					$response['errors'] = $response['errors'] + $this->process_validation_errors($validator['errors'], $key_offset);
					
				}

				if($quality == true) {
					$datajson_qa = $this->campaign->datajson_qa($chunk, $schema);	

					if(!empty($datajson_qa)) {
						$response['qa'] = array_merge_recursive($response['qa'], $datajson_qa);	
					}	

				}
								
			}




			if(!empty($response['qa'])) {


				if(!empty($response['qa']['bureauCodes'])) {
					$response['qa']['bureauCodes'] = array_keys($response['qa']['bureauCodes']);
				}

				if(!empty($response['qa']['programCodes'])) {
					$response['qa']['programCodes'] = array_keys($response['qa']['programCodes']);
				}

				$sum_array_fields = array('accessURL_present', 'accessURL_total', 'accessLevel_public', 'accessLevel_restricted', 'accessLevel_nonpublic');

				foreach ($sum_array_fields as $array_field) {
					if(!empty($response['qa'][$array_field]) && is_array($response['qa'][$array_field])) {					
						$response['qa'][$array_field] = array_sum($response['qa'][$array_field]);					 
					}	
				}

			}

			$valid_json = (isset($raw_valid_json)) ? $raw_valid_json : $valid_json;

			$response['valid'] = (empty($response['errors'])) ? true : false;
			$response['total_records'] = count($datajson_decode);
			$response['valid_json'] = $valid_json;


			if(!empty($datajson_header['download_content_length'])) {
				$response['download_content_length'] = $datajson_header['download_content_length'];
			}

			if(empty($response['errors'])) {
				$response['errors'] = false;
			}

			if ($return_source) {				
				$datajson_decode = filter_json($datajson_decode);			
				$response['source'] = $datajson_decode;
			}

			return $response;

		} else {			
			$errors[] = "This does not appear to be valid JSON";
			$response = array(
							'valid_json' => false, 
							'valid' => false, 
							'fail' => $errors 
							);
			if(!empty($datajson_header['download_content_length'])) {
				$response['download_content_length'] = $datajson_header['download_content_length'];
			}

			return $response;
		}



	}

	public function jsonschema_validator($data, $schema = null) {


		if($data) {

			$schema_variant = (!empty($schema)) ? "$schema/" : "";
			$path = './schema/' . $schema_variant . 'catalog.json';

			//echo $path; exit;

			// Get the schema and data as objects
	        $retriever = new JsonSchema\Uri\UriRetriever;
	        $schema = $retriever->retrieve('file://' . realpath($path));


        	 //header('Content-type: application/json');
        	 //print $data;
        	 //exit;

    		$data = json_decode($data);

		    if(!empty($data)) {
                // If you use $ref or if you are unsure, resolve those references here
                // This modifies the $schema object
                $refResolver = new JsonSchema\RefResolver($retriever);
                $refResolver->resolve($schema, 'file://' . __DIR__ . '/../../schema/' . $schema_variant);

                // Validate
                $validator = new JsonSchema\Validator();
                $validator->check($data, $schema);

                if ($validator->isValid()) {
                    $results = array('valid' => true, 'errors' => false);
                } else {
                    $errors =  $validator->getErrors();

                    $results = array('valid' => false, 'errors' => $errors);
                }

          	   //header('Content-type: application/json');
          	   //print json_encode($results);
          	   //exit;

                return $results;
            } else {
                return false;
            }

    	}



	}



	public function process_validation_errors($errors, $offset = null) {


		$output = array();

		foreach ($errors as $error) {

			if(is_numeric($error['property'])) {
				$key = $error['property'];
				$field = 'ALL';
			} else {

				$key = substr($error['property'], 0, strpos($error['property'], '.'));
				$full_field = substr($error['property'], strpos($error['property'], '.') + 1);

				if (strpos($full_field, '[')) {
					$field 		= substr($full_field, 0, strpos($full_field, '[') );
					$subfield 	= 'child-' . get_between($full_field, '[', ']');
				} else {
					$field = $full_field;
				}

			}

			if ($offset) {
				$key = $key + $offset;
			}

			if (isset($subfield)) {
				$output[$key][$field]['sub_fields'][$subfield][] = $error['message'];
			} else {
				$output[$key][$field]['errors'][] = $error['message'];
			}

			unset($subfield);



		}

		return $output;

	}





	public function datajson_qa($json, $schema = null) {

		$programCode = array();
		$bureauCode = array();

		$accessLevel_public			= 0;
		$accessLevel_restricted		= 0;
		$accessLevel_nonpublic		= 0;

		$accessURL_total	= 0;
		$accessURL_present 	= 0;

		$json = json_decode($json);

		foreach ($json as $dataset) {


			if($schema == 'federal') {

				if(!empty($dataset->accessLevel)) {


					if ($dataset->accessLevel == 'public') {
						$accessLevel_public++;
					} else if ($dataset->accessLevel == 'restricted public') {
						$accessLevel_restricted++;
					} else if ($dataset->accessLevel == 'non-public') {
						$accessLevel_nonpublic++;
					}

				} 


				if(!empty($dataset->programCode) && is_array($dataset->programCode)) {

					foreach ($dataset->programCode as $program) {
						$programCode[$program] = true;	
					}
					
				}

				if(!empty($dataset->bureauCode) && is_array($dataset->bureauCode)) {

					foreach ($dataset->bureauCode as $bureau) {
						$bureauCode[$bureau] = true;	
					}
				}				
			}


			$has_accessURL = false;

			if(!empty($dataset->accessURL) && filter_var($dataset->accessURL, FILTER_VALIDATE_URL)) {
				$accessURL_total++;
				$has_accessURL = true;
			}

			if(!empty($dataset->webService) && filter_var($dataset->webService, FILTER_VALIDATE_URL)) {
				$accessURL_total++;
				$has_accessURL = true;
			}			

			if(!empty($dataset->distribution) && is_array($dataset->distribution)) {
				
				foreach ($dataset->distribution as $distribution) {
					if(!empty($distribution->accessURL) && filter_var($distribution->accessURL, FILTER_VALIDATE_URL)) {
						$accessURL_total++;
						$has_accessURL = true;
					}					
				}

			}

			if($has_accessURL) $accessURL_present++;


		}

		$qa = array();

		if($schema == 'federal') {

			$qa['programCodes'] 				= $programCode;
			$qa['bureauCodes'] 					= $bureauCode;

			$qa['accessLevel_public']			= $accessLevel_public;
			$qa['accessLevel_restricted']		= $accessLevel_restricted;
			$qa['accessLevel_nonpublic']		= $accessLevel_nonpublic;
		}

		$qa['accessURL_present'] 	= $accessURL_present;
		$qa['accessURL_total'] 		= $accessURL_total;


		return $qa;

			// qa

			// access level count
			// downloadable - overall and per record
			// programs
			// bureaus
			// formats

	}



	public function update_status($update) {

		// Determine current milestone
		$selected_milestone	= (!empty($update->milestone)) ? $update->milestone : null;
		$milestones 			= $this->milestones_model();	
		$milestone 				= $this->milestone_filter($selected_milestone, $milestones);

		$update->milestone 		= $milestone->selected_milestone;

		$this->db->select('*');
		$this->db->where('office_id', $update->office_id);
		$this->db->where('milestone', $update->milestone);

		$query = $this->db->get('datagov_campaign');

		if ($query->num_rows() > 0) {
			// update

			if ($this->environment == 'terminal') {
				echo 'Updating ' . $update->office_id . PHP_EOL . PHP_EOL;
			}

			//$current_data = $query->row_array();
			//$update = array_mash($update, $current_data);

			$this->db->where('office_id', $update->office_id);
			$this->db->where('milestone', $update->milestone);

			$this->db->update('datagov_campaign', $update);



		} else {
			// insert

			if ($this->environment == 'terminal') {
				echo 'Adding ' . $update->office_id . PHP_EOL . PHP_EOL;
			}

			$this->db->insert('datagov_campaign', $update);

		}

	}


	public function update_note($update) {

		$this->db->select('note');
		$this->db->where('office_id', $update->office_id);
		$this->db->where('milestone', $update->milestone);
		$this->db->where('field_name', $update->field_name);
		
		$query = $this->db->get('notes');

		if ($query->num_rows() > 0) {
			// update

			if ($this->environment == 'terminal') {
				echo 'Updating ' . $update->office_id . PHP_EOL . PHP_EOL;
			}

			//$current_data = $query->row_array();
			//$update = array_mash($update, $current_data);

			$this->db->where('office_id', $update->office_id);
			$this->db->where('milestone', $update->milestone);
			$this->db->where('field_name', $update->field_name);

			$this->db->update('notes', $update);



		} else {
			// insert

			if ($this->environment == 'terminal') {
				echo 'Adding ' . $update->office_id . PHP_EOL . PHP_EOL;
			}

			$this->db->insert('notes', $update);

		}

	}

	public function get_notes($office_id, $milestone) {

		$query = $this->db->get_where('notes', array('office_id' => $office_id, 'milestone' => $milestone));

		return $query;

	}





	public function datajson_schema() {

		$schema = json_decode(file_get_contents(realpath('./schema/catalog.json')));

		if (!empty($schema->items->{'$ref'})) {

			$schema = json_decode(file_get_contents(realpath('./schema/' . $schema->items->{'$ref'})));

		}
		return $schema;

	}


	public function schema_to_model($schema) {

		$model = new stdClass();

		foreach ($schema as $key => $value) {

			if(!empty($value->items) && $value->type == 'array') {
				 $model->$key = array();
			} else {
				$model->$key = null;
			}

		}

		return $model;

	}

	public function get_datagov_json($orgs, $geospatial = false, $rows = 100, $offset = 0, $raw = false, $allow_harvest_sources = 'true') {

		$allow_harvest_sources = (empty($allow_harvest_sources)) ? 'true' : $allow_harvest_sources;

		if ($geospatial == 'both') {
		    $filter = "%20";
		} else if ($geospatial == 'true') {
		    $filter = 'metadata_type:geospatial%20AND%20';
		} else {
			$filter = '-metadata_type:geospatial%20AND%20';
		}

		if ($allow_harvest_sources !== 'true') {
			$filter .= "AND%20-harvest_source_id:[''%20TO%20*]";
		}

		if(strpos($orgs, 'http://') !== false) {

			$uri = $orgs;
			$from_export = true;

		} else {

			$orgs = rawurlencode($orgs);
			$query = $filter . "-type:harvest%20AND%20organization:(" . $orgs . ")&rows=" . $rows . '&start=' . $offset;
			$uri = 'http://catalog.data.gov/api/3/action/package_search?q=' . $query;
			$from_export = false;
		}

		$datagov_json = curl_from_json($uri, false);

		if($from_export) {

			$object_shim = new stdClass();
			$object_shim->result 			= new stdClass();
			$object_shim->result->count 	= count($datagov_json);
			$object_shim->result->results 	= $datagov_json;

			$datagov_json = $object_shim;
		}

		if(empty($datagov_json)) return false;

		if($raw == true) {
			return $datagov_json;
		} else {
			return $datagov_json->result->results;
		}

	}

	public function datajson_crosswalk($raw_data, $datajson_model) {

		$distributions = array();
		foreach($raw_data->resources as $resource) {
			$distribution = new stdClass();

			$distribution->accessURL 	= $resource->url;
			$distribution->format		= $resource->format;

			$distributions[] = $distribution;
		}

		if(!empty($raw_data->tags)) {
			$tags = array();
			foreach ($raw_data->tags as $tag) {
				$tags[] = $tag->name;
			}
		} else {
			$tags = null;
		}

		if(!empty($raw_data->extras)) {

		    foreach($raw_data->extras as $extra) {

		        if ($extra->key == 'tags') {
		            $extra_tags = $extra->value;
		            $datajson_model->keyword = (!empty($extra_tags)) ? array_map('trim',explode(",",$extra_tags)) : null;
		        }

		        if ($extra->key == 'data-dictiionary' OR $extra->key == 'data-dictionary') {
		            $datajson_model->dataDictionary = $extra->value;
		        }

		        if ($extra->key == 'person') {
		            $datajson_model->contactPoint = $extra->value;
		        }

		        if ($extra->key == 'contact-email') {
		            $datajson_model->mbox = $extra->value;
		        }

		        if ($extra->key == 'frequency-of-update') {
		            $datajson_model->accrualPeriodicity = $extra->value;
		        }

		        if ($extra->key == 'issued') {
		            $datajson_model->issued = date(DATE_ISO8601, strtotime($extra->value));
		        }

		        if ($extra->key == 'theme') {
		            $datajson_model->theme = $extra->value;
		        }

		        if ($extra->key == 'access-level') {
		            $datajson_model->accessLevel = $extra->value;
		        }

		        if ($extra->key == 'license' OR $extra->key == 'licence') {
		            $license = trim($extra->value);

		            if(!empty($license)) {
		                $datajson_model->license = $license;
		            }

		        }



		    }


        }




	    $datajson_model->accessURL                          = null;
//		$datajson_model->accessLevel                        = $datajson_model->accessLevel;
		$datajson_model->accessLevelComment                 = null;
//		$datajson_model->accrualPeriodicity                 = $datajson_model->accrualPeriodicity;
		$datajson_model->bureauCode                         = null;
		$datajson_model->contactPoint                       = (!empty($datajson_model->contactPoint)) ? $datajson_model->contactPoint : $raw_data->maintainer;
//		$datajson_model->dataDictionary                     = $datajson_model->dataDictionary;
		$datajson_model->dataQuality                        = null;
		$datajson_model->description                        = $raw_data->notes;
		$datajson_model->distribution                       = $distributions;
	    $datajson_model->format                             = null;
		$datajson_model->identifier                         = $raw_data->id;
//		$datajson_model->issued                             = $datajson_model->issued;
		$datajson_model->keyword                            = (!empty($datajson_model->keyword)) ? $datajson_model->keyword : $tags;
		$datajson_model->landingPage                        = null;
		$datajson_model->language                           = null;
//		$datajson_model->license                            = $datajson_model->license;
		$datajson_model->mbox                               = (!empty($datajson_model->mbox)) ? $datajson_model->mbox : $raw_data->maintainer_email;
		$datajson_model->modified                           = date(DATE_ISO8601, strtotime($raw_data->metadata_modified));
		$datajson_model->PrimaryITInvestmentUII             = null;
		$datajson_model->programCode                        = null;
		$datajson_model->publisher                          = $raw_data->organization->title;
		$datajson_model->references                         = null;
		$datajson_model->spatial                            = null;
		$datajson_model->systemOfRecords                    = null;
		$datajson_model->temporal                           = null;
//		$datajson_model->theme                              = $datajson_model->theme;
		$datajson_model->title                              = $raw_data->title;
		$datajson_model->webService                         = null;

		return $datajson_model;
	}


}

?>