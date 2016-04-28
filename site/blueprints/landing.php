<?php if(!defined('KIRBY')) exit ?>

title: Landing
pages: false
deletable: false
files: true
fields:
  title:
    label: Title
    type:  text
  intro:
    label: Intro
    type: textarea
  outro:
    label: Outro
    type: textarea
  moreimages: 
    label: Additional category images
    type: structure
    style: table
    fields: 
      category: 
        label: Category
        type:  text
      content: 
        label: Image
        type:  text
        type:  selector
        mode:  single
        types:
            - image