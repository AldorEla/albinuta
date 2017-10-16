Albinuta WebAPP
============================
> Albinuta is an online space for stories for kids.
> Some of them may have video available, some may only be written stories.
> Some of them might be crawled from Youtube (or other similar websites),
> some of them might be added by admin through our interface.

## Main Bundles
- AlbFrontendBundle: Display content logically processed from AlbAppBundle
- AlbBackendBundle: Display content logically processed from AlbAppBundle
  * SonataAdminBundle
- AlbAppBundle: Logic happens here

## Tools and frameworkds
- Symfony 3 PHP framework
- Bootstrap 4 CSS framework
- jQuery

## Features
1. All frontend pages:
- Top Navigation
- Footer
- Change Colour Theme
2. HOMEPAGE:
- Hero bxSlider with saved content
- Listing of saved stories in boxes grid
- Youtube Online Playlist crawled with DomCrawler within AlbAppBundle
3. Story:
- CRUD pages
4. Admin:
- SonataAdminBundle, path "/admin"


@todo:
1. Animate logo horizontally - [DONE]
2. Integrate TinyMCE for Story content field - [DONE]
3. File uploader for images [WIP] - VichUploaderBundle - [DONE]
4. Add Playlist dynamically
5. Add some shine in the layout of all pages
6. Change Colour Theme - [DONE]
7. Change layout Theme

## Changes/Feature integrations
1. Animate logo horizontally
2. Integrate TinyMCE for Story content field
3. File uploader for images
4. Change Colour Theme