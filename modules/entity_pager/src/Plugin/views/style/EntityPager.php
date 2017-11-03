<?php

namespace Drupal\entity_pager\Plugin\views\style;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Annotation\ViewsStyle;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Style plugin to render a view for an Entity Pager.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "entity_pager",
 *   title = @Translation("Entity Pager"),
 *   help = @Translation("Displays extra information on a Entity such as Next and Previous links."),
 *   theme = "entity_pager",
 *   display_types = { "normal" }
 * )
 */
class EntityPager extends StylePluginBase {
  protected $usesRowPlugin = FALSE;

  protected $usesRowClass = FALSE;

  protected $usesFields = TRUE;

  protected $usesOptions = TRUE;

  /**
   * Returns an array of default options for the entity pager.
   *
   * @return array
   *   The default options.
   */
  protected function getDefaultOptions() {
    return [
      'link_next' => 'next >',
      'link_prev' => '< prev',
      'link_all_url' => '<front>',
      'link_all_text' => 'Home',
      'display_all' => TRUE,
      'display_count' => TRUE,
      'log_performance' => TRUE,
    ];
  }

  /**
   * Returns a value for an option.
   *
   * @param string $name
   *   The option name.
   *
   * @return mixed
   *   The option value, falling back to the default.
   */
  protected function getOption($name) {
    $defaults = $this->getDefaultOptions();

    return (isset($this->options['next_prev'][$name])) ? $this->options['next_prev'][$name] : $defaults[$name];
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $defaults = $this->getDefaultOptions();

    return parent::defineOptions() + [
        'link_next' => ['default' => $defaults['link_next']],
        'link_prev' => ['default' => $defaults['link_prev']],
        'link_all_url' => ['default' => $defaults['link_all_url']],
        'link_all_text' => ['default' => $defaults['link_all_text']],
        'display_all' => ['default' => $defaults['display_all']],
        'display_count' => ['default' => $defaults['display_count']],
        'log_performance' => ['default' => $defaults['log_performance']],
      ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    // Setup an options form.
    $form['next_prev'] = [
      '#type' => 'details',
      '#open' => TRUE,
      '#title' => $this->t('Next/Previous links'),
      '#description' => $this->t('Configure the Next and Previous links.'),
    ];

    $form['next_prev']['link_next'] = [
      '#title' => $this->t('Next label'),
      '#description' => $this->t('The text to display for the Next link. HTML is allowed.'),
      '#type' => 'textfield',
      '#default_value' => $this->getOption('link_next'),
    ];

    $form['next_prev']['link_prev'] = [
      '#title' => $this->t('Previous label'),
      '#description' => $this->t('The text to display for the Previous link. HTML is allowed.'),
      '#type' => 'textfield',
      '#default_value' => $this->getOption('link_prev'),
    ];

    $form['next_prev']['link_all_url'] = [
      '#title' => $this->t('List All URL'),
      '#description' => $this->t('The <strong>URL</strong> of the listing Link.<br>
          Examples include:
          <ul>
              <li>the URL of a Views listing page of the Entities.</li>
              <li><strong>@front</strong> for the <strong>homepage</strong></li>
              <li>a <a href="/admin/help/token"><strong>Token</strong></a> that
              relates to the Entity.  e.g. [node:edit-url]</li>
              <li>The token can also be an <strong>entity reference</strong> if the entity
              has one.  e.g. [node:field_company]</li>
          </ul>', array('@front' => '<front>')),
      '#type' => 'textfield',
      '#default_value' => $this->getOption('link_all_url'),
    ];

    $form['next_prev']['link_all_text'] = [
      '#title' => t('List All label'),
      '#description' => t("The <strong>text</strong>
          to display for the <strong>List All URL.
          </strong>
          <ul>
              <li>When an <strong>entity reference</strong> is used in
              the <strong>List All URL</strong> box above, just add the same
              entity reference in this box and the referenced
              <strong>Entity Title</strong> will automatically be displayed.
              </li>
              <li>HTML is allowed.</li>
          </ul>"
      ),
      '#type' => 'textfield',
      '#default_value' => $this->getOption('link_all_text'),
    ];

    $form['next_prev']['display_all'] = [
      '#title' => t('Display All link'),
      '#description' => t('Display a link to the parent page of all results.'),
      '#type' => 'checkbox',
      '#default_value' => $this->getOption('display_all'),
    ];

    $form['next_prev']['display_count'] = [
      '#title' => t('Display count'),
      '#description' => t('Display the number of records e.g. 5 of 8'),
      '#type' => 'checkbox',
      '#default_value' => $this->getOption('display_count'),
    ];

    $form['next_prev']['log_performance'] = [
      '#title' => t('Log performance suggestions'),
      '#description' => t('Log performance suggestions to Watchdog, see: Reports > Recent Log Messages.'),
      '#type' => 'checkbox',
      '#default_value' => $this->getOption('log_performance'),
    ];
  }
}
