import { Fragment } from 'wp.element';
import { __ } from 'wp.i18n';
import { useSelect } from 'wp.data';
import { SelectControl, PanelBody, Spinner } from 'wp.components';
import { InspectorControls } from 'wp.blockEditor';
import classNames from 'classnames';

import useUniqueId from './hooks/useUniqueId';
import Logo from './maxslider-logo.svg';

const MaxSliderEdit = ({ attributes, setAttributes, className, clientId }) => {
  const { uniqueId, id, template } = attributes;
  const classes = classNames({
    [className]: !!className,
    [`maxslider-block-${uniqueId}`]: !!uniqueId,
  });

  useUniqueId({ attributes, setAttributes, clientId });

  const { sliders } = useSelect(select => {
    const { getEntityRecords } = select('core');

    return {
      sliders: getEntityRecords('postType', 'maxslider_slider', {
        per_page: -1,
      }),
    };
  });
  const { templates } = window.__MAXSLIDER_SETTINGS__ ?? {};
  const loading = !sliders;

  const slideSelector = loading ? (
    <div
      style={{
        textAlign: 'center',
      }}
    >
      <Spinner />
    </div>
  ) : (
    <SelectControl
      label={__('Slider')}
      value={id}
      options={[
        {
          label: __('Select a slider'),
          value: '',
        },
        ...(sliders || []).map(slider => ({
          label: slider.title.raw,
          value: slider.id,
        })),
      ]}
      onChange={value => setAttributes({ id: value })}
    />
  );

  return (
    <Fragment>
      <div id={`maxslider-block-${uniqueId}`} className={classes}>
        <div className="maxslider-block-placeholder">
          <div className="maxslider-block-placeholder-inner">
            <Logo
              className="maxslider-block-placeholder-logo"
              viewBox="0 0 100 29"
            />
            {slideSelector}
          </div>
        </div>
      </div>

      <InspectorControls>
        <PanelBody title={__('Settings')} initialOpen>
          {slideSelector}

          {!loading && templates && Object.keys(templates)?.length > 0 && (
            <SelectControl
              label={__('Template')}
              value={template}
              options={[
                ...(Object.keys(templates) || []).map(key => {
                  return {
                    label: templates[key].label,
                    value: key,
                  };
                }),
              ]}
              onChange={value => {
                setAttributes({ template: value });
              }}
            />
          )}
        </PanelBody>
      </InspectorControls>
    </Fragment>
  );
};

export default MaxSliderEdit;
