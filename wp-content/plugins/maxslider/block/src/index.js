import { __ } from 'wp.i18n';
import { registerBlockType } from 'wp.blocks';

import MaxSliderEdit from './edit';
import BlockIcon from './block-icon';

import './styles/editor.scss';

registerBlockType('maxslider/slider', {
  title: __('MaxSlider'),
  description: __('Display your MaxSlider slideshow'),
  icon: BlockIcon,
  category: 'maxslider',
  keywords: [__('slider'), __('slideshow'), 'maxslider'],
  supports: {
    align: ['wide', 'full'],
  },
  attributes: {
    uniqueId: {
      type: 'string',
    },
    id: {
      type: 'string',
    },
    template: {
      type: 'string',
    },
    className: {
      type: 'string',
      default: '',
    },
  },
  edit: MaxSliderEdit,
  save: () => null,
});
