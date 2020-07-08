## About
Organises Laravel nova sidebar menu to use groups as top level items with costum icon support
## Notes
Uses native javascript to open close groups and subgroups (without animations). 
Resource groups will be used as main category.
## Installation
Copy all files to resource directory in your project.
## Usage
Create new static function subGroup() and return name of your subGroup.
Put your costum icons in /resources/views/nova/icons/ directory (file name will be slugfied version of group name. Example group name: My New Group / File name: my-new-group.blade.php).
## Preview
 ![](https://s7.gifyu.com/images/screen-capture.gif)
