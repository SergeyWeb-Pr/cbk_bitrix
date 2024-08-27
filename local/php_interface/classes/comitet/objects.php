<?php

namespace Comitet;

 if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Lst\Site;

class Objects
{
  
  public static function getData($object_id)
  {
    $object = Site::get_element_by_id(OBJECTS_IBLOCK_ID,$object_id);
    if(!empty($object[0]))
      $object = $object[0];
    else
      return false;
    $votes_for     = (int) $object['PROPERTIES']['VOTES_COUNT_FOR']['VALUE'];
    $votes_againts = (int) $object['PROPERTIES']['VOTES_COUNT_AGAINST']['VALUE'];
    $all_votes     = $votes_for+$votes_againts;

    if(empty($votes_for))
      $votes_for_percent = 0;
    else
      $votes_for_percent = number_format($votes_for*100/$all_votes,1);
    
    if(empty($votes_againts))
      $votes_againts_percent = 0;
    else
      $votes_againts_percent = number_format($votes_againts*100/$all_votes,1);
      
    return ['against' => $votes_againts_percent, 'for' => $votes_for_percent, 'all' => $all_votes];
  }
  
  public static function getRatingSidebarMarkup($object_id)
  {
      $data = self::getData($object_id);
      extract($data);
      ob_start();
      ?>
  
      <?php //if(!empty($all)): ?>

        <div class="module module__rate mb-lg-4 mb-3" data-content="object-sidebar-vote">
            <div class="block__rate">

            <?php //if(!empty($for)): ?>
              <div class="block__rate--row mb-2">
                <div class="d-flex justify-content-between mb-1"><strong>За реализацию</strong><strong><?php echo $for; ?>%</strong></div>
                <div class="rate__line yes"><span style="width: <?php echo $for; ?>%"></span></div>
              </div>
            <?php //endif; ?>

            <?php //if(!empty($against)): ?>
              <div class="block__rate--row">
                <div class="d-flex justify-content-between mb-1"><strong>Против реализации</strong><strong><?php echo $against; ?>%</strong></div>
                <div class="rate__line no"><span style="width: <?php echo $against; ?>%"></span></div>
              </div>
            <?php //endif; ?>

            </div>
        </div>

      <?php //endif; ?>
      <?php
      return ob_get_clean();
  }
  
  public static function getRatingInList($object_id)
  {
    $data = self::getData($object_id);
    extract($data);
    ob_start();
    ?>

    <div class="block__rate line-grey">
      <div class="block__rate--row mb-2">
        <div class="d-flex justify-content-between mb-1"><strong>За реализацию</strong><strong>&nbsp;<?php echo $for; ?>%</strong></div>
        <div class="rate__line yes"><span style="width: <?php echo $for; ?>%"></span></div>
      </div>
      <div class="block__rate--row">
        <div class="d-flex justify-content-between mb-1"><strong>Против реализации</strong><strong>&nbsp;<?php echo $against; ?>%</strong></div>
        <div class="rate__line no"><span style="width: <?php echo $against; ?>%"></span></div>
      </div>
    </div>

    <?php
    return ob_get_clean();
  }
  
  public static function getRatingModalMarkup($object_id)
  {
    $data = self::getData($object_id);
    extract($data);
    ob_start();
    ?>
    
    <?php //if($all): ?>
      <div class="module module__rate" data-content="object-modal-vote">
        <div class="block__rate">
          
          
          <?php //if(!empty($for)): ?>
           
            <div class="block__rate--row mb-2">
              <div class="d-flex justify-content-between mb-1"><strong>За реализацию</strong><strong><?php echo $for; ?>%</strong></div>
              <div class="rate__line yes mb-1"><span style="width: <?php echo $for; ?>%"></span></div>
              <div class="voice__link">
                <a href="#" data-object-id="<?php echo $object_id; ?>" data-action="for" class="vote-link">
                  <i class="icon-svg">
                    <svg class="icon-like undefined" width="20" height="18" viewBox="0 0 20 18">
                      <use xlink:href="<?php echo SITE_TEMPLATE_PATH?>/assets/svg/symbols.svg#like"></use>
                    </svg>
                  </i>
                  <span>Проголосовать ЗА</span>
                </a>
              </div>
            </div>
            
          <?php // endif; ?>
          
          
          <?php // if(!empty(againts)): ?>
            <div class="block__rate--row">
              <div class="d-flex justify-content-between mb-1"><strong>Против реализации</strong><strong><?php echo $against; ?>%</strong></div>
              <div class="rate__line no mb-1"><span style="width: <?php echo $against; ?>%"></span></div>
              <div class="voice__link">
                <a href="#"  data-object-id="<?php echo $object_id; ?>" data-action="against" class="vote-link">
                  <i class="icon-svg">
                    <svg class="icon-like undefined" width="20" height="18" viewBox="0 0 20 18">
                      <use xlink:href="<?php echo SITE_TEMPLATE_PATH?>/assets/svg/symbols.svg#like"></use>
                    </svg>
                  </i>
                  <span>Проголосовать ПРОТИВ</span>
                </a>
              </div>
            </div>
          <?php // endif; ?>
          
          
        </div>
      </div>
    <?php //endif; ?>

    <?php
    
    return ob_get_clean();
    
  }
  
}