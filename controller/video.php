<?php

class Video extends CI_Controller {

        /* Integratte with  Heywatch */
        public function step1(){
            set_time_limit(0);
            $username = ' ';
            $password = ' ';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                 "format"  => "xml"
                );
            $this->load->library('Heywatch',$credentials);
            
            // upload video for conversion
             $video_file = UPLOAD_PATH.'video/sample_video.avi';
             if (file_exists($video_file)) {
                $var = $this->heywatch->upload($video_file);

                echo '<pre>';
                print_r($var);
             } else {
                 echo 'invalid video path';
             }
          
            
        }
        
         public function step2(){
          
            $username = '';
            $password = '';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                 "format"  => "json"
                );
            $this->load->library('Heywatch',$credentials);
            
            
            // create the encoding format
             
             $name = 'iPad';
             $options  = array("category"=>"devices",
                                "container"=>"mp4",
                               "video_codec"=>"h264",
                               "video_bitrate"=>"1500",
                               "fps"=>"30",
                               "width"=>"1280",
                               "height"=>"729",
                               "audio_channels"=>"2",
                               "audio_codec"=>"aac",
                               "audio_bitrate"=>"128",
                               "sample_rate"=>"44000",
                               "two_pass"=>"false"
                 );
             $video_format = $this->heywatch->createFormat($name,$options);
            
             echo "Format id = ".$video_format->id;
          
            
        }
        
        public function step3(){
            
          
            $username = '';
            $password = '';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                  "format" =>"json");
            $this->load->library('Heywatch',$credentials);
            
            // create the job to encode
            $video_id  = 12924923;
            $video_format_id = 7982;
            $job = $this->heywatch->createJob($video_id,$video_format_id);            
            echo "Job id = ".$job->id;
             
            
        }
        
        public function step4(){
            
            
            $username = '';
            $password = '';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                 "format"  =>"json");
            $this->load->library('Heywatch',$credentials);
            
            // create the job to encode
            $job_id  = 6640661;
            $job_info = $this->heywatch->getJob($job_id);            
              
            echo 'Job information';
            echo '<pre>'; 
            var_dump($job_info);
            
            echo "Job status : ".$job_info->status;
        }
        
          public function step5(){
            
            set_time_limit(0);
            $username = '';
            $password = '';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                 "format"=>"json");
            $this->load->library('Heywatch',$credentials);
            
            // create the job to encode
            $encoded_video_id  = 12925768;
            $var = $this->heywatch->getEncodedVideo($encoded_video_id);       
            $link  = $var->link;
            $path =  UPLOAD_PATH.'video/converted/encoeded_heywatch_'.md5(time()).'.mp4';
            
            $success =$this->heywatch->saveVideoToPath($link,$path);
            var_dump($success);
            
        }
}


/* Location: ./system/application/controllers/Video.php */
