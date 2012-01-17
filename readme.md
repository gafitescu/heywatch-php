HeyWatch Codeigniter  class
=============

[Hey!Watch](http://heywatch.com) provides a simple and robust encoding platform. The service allows developers to access a fast, scalable and inexpensive web service to encode videos easier. The API can be easily integrated in any web or desktop applications.

The documentation of the API can be found at http://wiki.heywatch.com/API_Documentation

Usage
-------------

## Upload local video file to heywatch

<blockquote>
public function step1(){
            set_time_limit(0);
            $username = '';
            $password = '';
            $credentials = array("username"=>$username,
                                 "password"=>$password,
                                 "format"  => "xml" // at the moment for some reason the json format is not working on upload method
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
</blockquote>     
        
