Albinuta WebAPP
========================================================================================
> Albinuta is an online space for stories for kids.
> Some of them may have video available, some may only be written stories.
> Some of them might be crawled from Youtube (or other similar websites),
> some of them might be added by admin through our interface.

## Main Bundles
- AlbFrontendBundle: Display content logically processed from AlbAppBundle
- AlbBackendBundle: Display content logically processed from AlbAppBundle - SonataAdminBundle CMS
- AlbAppBundle: Logic happens here

## Tools and Frameworks
- Symfony 3 PHP framework
- Bootstrap 4 CSS framework
- jQuery v3.2.1 JS library

## Features
1. All frontend pages:  
Top Navigation  
Footer  
Change Colour Theme  
2. Homepage:  
Hero bxSlider with saved content  
Listing of saved stories in boxes grid  
Youtube Online Playlist crawled with DomCrawler within AlbAppBundle  
3. Story:  
CRUD pages  
Clone story - listing page [@TBD]  
Save as new - details page [@TBD]  
4. Admin:  
SonataAdminBundle, path "/admin"  
5. Frontend User:  
Register and login to use "My Space" feature [@TBD]  
6. My Space:  
Playground for registered users [@TBD]  
7. PriceHunter, json content with products provided by an external url
8. ElasticSearch:
- Installation guide: https://www.elastic.co/guide/en/elasticsearch/reference/current/_installation.html
- Populate using the bundle provoded by FOS:
```
console fos:elastica:populate
```

Development Notes
========================================================================================
> Features to be integrated or already integrated.

## @todo
 1. Animate logo horizontally
 2. Integrate TinyMCE for Story content field
 3. File uploader for images [WIP] - VichUploaderBundle
 4. Add some shine in the layout of all pages
 5. Change Colour Theme on Frontend
 6. Add Playlist dynamically [@TBD]
 7. Change layout Theme [@TBD]
 8. Integrate FOS User bundle for Sonata Admin Bundle [@TBD]
 9. Integrate FOS User bundle for frontend user authentication [@TBD]
10. Clone Story - listing page [@TBD]
11. Save as new - edit page [@TBD]
12. My Space - for authenticated user [@TBD]

## Feature integrations
 1. Animate logo horizontally
 2. Integrate TinyMCE for Story content field
 3. File uploader for images
 4. Change Colour Theme: Integration of 3 basic colour themes [default, dark, light]
 5. PriceHunter - import products from Price Hunter url, json content
 6. ElasticSearch search for PH products