<?php
/**
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Get weather
 *
 * @param array $params
 * @param Smarty_Internal_Template $smarty
 * @return string
 */
function smarty_function_weather(array $params, Smarty_Internal_Template $smarty)
{
    $hour = date('H');
    $container = \Zend_Registry::get('container');
    $em = $container->get('doctrine')->getManager();
    $meteoblueStatRepo = $em->getRepository('Newscoop\MeteobluePluginBundle\Entity\MeteoblueStat');

    // get temperature
    $tempStat = $meteoblueStatRepo->findOneBy(array('option' => 'weather_temperature_'.$hour));
    $temperature = $tempStat->getValue();

    // get icon
    $iconStat = $meteoblueStatRepo->findOneBy(array('option' => 'weather_icon_'.$hour));
    $icon = $iconStat->getValue();
    
    $result = '<span class="'.$icon.'">'.$temperature.'°C Basel</span>';
    
    return($result);
}
