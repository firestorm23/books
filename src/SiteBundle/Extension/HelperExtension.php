<?php
namespace SiteBundle\Extension;

use Symfony\Component\HttpKernel\Kernel;
use Knp\Menu\Twig\Helper;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelperExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public $container;

    public $tstart;
    public $tend;


    const  DEFAULT_USER_PIC = "/static/assets/img/various/nophoto.png";


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function tStart() {
        $this->tstart = getrusage();
    }

    public function tEnd() {
        $this->tend = getrusage();
    }

    public function getScriptTimeMessage() {
        $message = array(
            "This process used " . $this->getrtime($this->tend, $this->tstart, "utime") .
            " ms for its computations\n",
            "It spent " . rutime($this->tend, $this->tstart, "stime") .
            " ms in system calls\n"
        );
        return $message;
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('relpath', array($this, 'getFileRelPath')),
            new \Twig_SimpleFilter('up', array($this, 'toUpper')),
        );
    }

    public function toUpper($string) {
        return mb_strtoupper($string, 'utf-8');
    }

    function getFileRelPath($absolute_path) {
        $webDir = $this->container->get('kernel')->getRootDir()."/../web";
        return strtr($absolute_path, array($webDir => ""));
    }

    public function getrtime($end, $start, $index) {
        return ($end["ru_$index.tv_sec"]*1000 + intval($end["ru_$index.tv_usec"]/1000))
        -  ($start["ru_$index.tv_sec"]*1000 + intval($start["ru_$index.tv_usec"]/1000));
    }

    public function getFunctions()
    {
        return array(
            'fileDump' => new \Twig_Function_Method($this, 'fileDump'),
            'getObjectVars' => new \Twig_Function_Method($this, 'getObjectVars'),
            'getClassMethods' => new \Twig_Function_Method($this, 'getClassMethods'),
            'keys' => new \Twig_Function_Method($this, 'keys'),
            'getFileName' => new \Twig_Function_Method($this, 'getFileName'),
            'tStart' => new \Twig_Function_Method($this, 'tStart'),
            'tEnd' => new \Twig_Function_Method($this, 'tEnd'),
            'getScriptTimeMessage' => new \Twig_Function_Method($this, 'getScriptTimeMessage'),
        );
    }

    public function fileDump($var, $append) {
        fileDump($var, $append);
    }


    public function keys($arr) {
        return array_keys($arr);
    }

    public function getFileName($file) {

        if (is_a($file, 'SiteBundle\Entity\File')) {
            return $file->getDirname()."/".$file->getName();
        }

    }

    public function getClassMethods($instance) {
        return get_class_methods($instance);
    }

    public function getObjectVars($instance) {
        $class = get_class($instance);
        $vars = get_object_vars($instance);
        $result = array();
        foreach ($vars as $v) {
            if (!is_a($v, $class)) {
                $result[] = $v;
            }
        }
        return $result;
    }

    public function getName() {
        return 'helper_extension';
    }
}
?>