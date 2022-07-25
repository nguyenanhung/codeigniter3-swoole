<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class TestSwoole
 *
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class TestSwoole extends CI_Controller
{

    // ------------------------------------------------------------------------------

    /**
     * here's the task
     */
    public function task()
    {
        $data = $this->input->post();

        log_message('error', var_export($data, true));
    }

    // ------------------------------------------------------------------------------

    /**
     * here's the timer method
     */
    public function task_timer()
    {
        log_message('error', 'timer works!');
    }

    // ------------------------------------------------------------------------------

    /**
     * send data to task
     */
    public function send()
    {
        try
        {
            \CiSwoole\Core\Client::send(
                [
                    'route'  => 'testswoole/task',
                    'params' => ['hope' => 'it works!'],
                ]);
        }
        catch (\Exception $e)
        {
            log_message('error', $e->getMessage());
            log_message('error', $e->getTraceAsString());
        }
    }

    // ------------------------------------------------------------------------------

}
