<?php if(!defined('KIRBY')) exit ?>

title: Project
pages: false
files: true
fields:
  gallerygrid:
    type: gallerygrid
  title:
    label: Title
    type:  text
    width: 1/2
  subtitle:
    label: Subtitle
    type:  text
    width: 1/2
  date:
    label: Date
    type: date
    format: YYYY
    width: 1/2
  categories:
    label: Categories
    type: tags
    lower: true
    help: design, art direction, digital, photography or brand content
    width: 1/2
  text:
    label: Text
    type:  textarea
    width: 1/2
  featured:
    label: Featured image
    type: select
    options: images
    width: 1/2
  thumbs: 
    label: Images
    type: structure
    entry: >
      <table style="width:100%; font-size: 11px">
      	<tr>
      		<td style="width:25%">Image</td>
      		<td style="width:25%">Caption</td>
      		<td style="width:25%">Video</td>
      		<td style="width:25%">Featured</td>
      	</tr>
      	<tr>
      		<td style="width:25%"><img src="{{_fileUrl}}{{content}}" width="60px"/><br>{{content}}</td>
      		<td style="width:25%">{{caption}}</td>
      		<td style="width:25%">{{video}}</td>
      		<td style="width:25%">{{featured}}</td>
      	</tr>
      </table>
    fields: 
      video:
        label: Video URL
        type: text
        icon: code
        help: Leave blank if image only 
      content: 
        label: Image
        type:  selector
        mode:  single
        types:
            - image
      caption: 
        label: Caption
        type:  text
      featured:
          label: Featured image
          type: checkbox
          help: In landing page
  pdf:
    label: PDF
    type: builder
    fieldsets:
      onecol:
        label: One image
        entry: >
          <img src="{{_fileUrl}}{{imageone}}" height=120px/>
        fields:
          imageone:
            label: Photo
            type: selector
            mode: single
            filter: /\.((png)|(jpe?g))/i
      twocol:
        label: Two images
        entry: >
          <img src="{{_fileUrl}}{{imageone}}" height=120px/>
          <img src="{{_fileUrl}}{{imagetwo}}" height=120px/>
        fields:
          imageone:
            label: Photo 1
            type: selector
            mode: single
            filter: /\.((png)|(jpe?g))/i
          imagetwo:
            label: Photo 2
            type: selector
            mode: single
            filter: /\.((png)|(jpe?g))/i