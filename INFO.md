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
- Clone story - listing page [@TBD]
- Save as new - details page [@TBD]
4. Admin:
- SonataAdminBundle, path "/admin"
5. Frontend User:
- Register and login to use "My Space" feature [@TBD]
6. My Space:
- Playground for registered users [@TBD]


@todo:
 1. Animate logo horizontally
 2. Integrate TinyMCE for Story content field
 3. File uploader for images [WIP] - VichUploaderBundle
 4. Add Playlist dynamically [@TBD]
 5. Add some shine in the layout of all pages
 6. Change Colour Theme
 7. Change layout Theme [@TBD]
 8. Integrate FOS User bundle for Sonata Admin Bundle [@TBD]
 9. Integrate FOS User bundle for frontend user authentication [@TBD]
10. Clone Story - listing page [@TBD]
11. Save as new - edit page [@TBD]
12. My Space - for authenticated user [@TBD]

## Changes/Feature integrations
 1. Animate logo horizontally
 2. Integrate TinyMCE for Story content field
 3. File uploader for images
 4. Change Colour Theme: Integration of 3 basic colour themes [default, dark, light]
