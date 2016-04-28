<?php if(!defined('KIRBY')) exit ?>

title: Contact
fields:
  title:
    label: Title
    type:  text
  contact:
    label: Contact infos
    type:  textarea
  sidebar:
    label: Additional infos
    type:  textarea
  credits:
    label: Credits
    type: textarea
  minitel:
    label: Minitel crawler
    type:  text
  socials:
    label: Social Links
    type: structure
    entry: >
      {{name}} - {{link}}
    fields:
      name:
        label: Name
        type: text
        icon: font
      link:
        label: Link
        type: url