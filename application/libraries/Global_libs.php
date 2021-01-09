<?php
class Global_libs
{
    public function set_session($sess_name, $sess_data)
    {
        $CI = &get_instance();
        $CI->session->set_userdata($sess_name, $sess_data);
    }

    public function del_session($data = "")
    {
        $CI = &get_instance();

        if (!empty($data)) {
            // $this->session->unset_userdata('variable'); // Unset a session
        } else {
            $CI->session->sess_destroy();
        }
    }

    /**
     * [Delete multiple files from directory, based by no_agenda]
     * @param  [type] $date   [date now]
     * @param  [type] $agenda [no_agenda]
     * @return [type]         [description]
     */
    public function del_files($date, $agenda)
    {
        // delete file data, if it's agenda number same as input post and a new file uploaded
        $files = array_diff(scandir('./resources/file/scanned_file/' . $date), array('..', '.'));
        if (!empty($files)) {
            foreach ($files as $file) {
                if (strpos($file, $agenda) !== false) {
                    unlink("./resources/file/scanned_file/" . $date . "/" . $file);
                }
            }
        }
    }

    public function del_spes_files($file)
    {
        // delete file data, if it's agenda number same as input post and a new file uploaded
        // $files = array_diff(scandir('./resources/file/scanned_file/' .$date), array('..', '.'));
        // if(!empty($files)) {
        // foreach($files as $file) {
        // if (strpos($file, $agenda) !== false) {
        unlink("./resources/file/logo/" . $file);
        // }
        // }
        // }
    }
}
