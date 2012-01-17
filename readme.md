HeyWatch Codeigniter  class
=============

[Hey!Watch](http://heywatch.com) provides a simple and robust encoding platform. The service allows developers to access a fast, scalable and inexpensive web service to encode videos easier. The API can be easily integrated in any web or desktop applications.

The documentation of the API can be found at http://wiki.heywatch.com/API_Documentation

Usage
-------------

## Upload local video file to heywatch

<pre>
public function step1() 
{
            set_time_limit(0);
            $username = '';
            $password = '';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                 "format"  => "xml");
            $this->load->library('Heywatch',$credentials);
             $video_file = UPLOAD_PATH.'video/sample_video.avi';
             if (file_exists($video_file)) {
                $var = $this->heywatch->upload($video_file);
                print_r($var);
             } else {
                 echo 'invalid video path';
             }
}
</pre>

        

## Create a format that a video should be converted to 
<pre>
public function step2(){
            $username = '';
            $password = '';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                 "format"  => "json"
                );
            $this->load->library('Heywatch',$credentials);
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
</pre>
        

## Create a job that a certain video needs to be encoede with a certain video format defined
<pre>
public function step3(){
            $username = 'danielgafitescu';
            $password = 'passwordvideo';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                  "format" =>"json");
            $this->load->library('Heywatch',$credentials);
            $video_id  = 12924923;
            $video_format_id = 7982;
            $job = $this->heywatch->createJob($video_id,$video_format_id);            
            echo "Job id = ".$job->id;
}
</pre>


     
## Check to see if the job has finished
<pre>
public function step4(){
            $username = 'danielgafitescu';
            $password = 'passwordvideo';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                 "format"  =>"json");
            $this->load->library('Heywatch',$credentials);
            $job_id  = 6640661;
            $job_info = $this->heywatch->getJob($job_id);    
            echo 'Job information';
            var_dump($job_info);
            
            echo "Job status : ".$job_info->status;
}
</pre>
      
## Download the video converted on a local path

<pre>
public function step5(){         
            set_time_limit(0);
            $username = 'danielgafitescu';
            $password = 'passwordvideo';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                 "format"=>"json");
            $this->load->library('Heywatch',$credentials);
            $encoded_video_id  = 12925768;
            $var = $this->heywatch->getEncodedVideo($encoded_video_id);       
            $link  = $var->link;
            $path =  UPLOAD_PATH.'video/converted/encoeded_heywatch_'.md5(time()).'.mp4';
            $success =$this->heywatch->saveVideoToPath($link,$path);
            var_dump($success);
            
        }
</pre>     