# CoreUI Panel

### Composer install

`composer install n2ref/coreui-panel`

### Example usage

```php
    $panel = new \CoreUI\Panel('panel-id');
    $panel->setTitle('Component Panel', 'CoreUI Framework');
    $panel->addControlButton('Help');
    
    $panel->setTabsType($panel::TABS_TYPE_TABS);
    $panel->setTabsPosition($panel::TABS_POS_TOP_LEFT);
    $panel->setTabsFill($panel::TABS_FILL_JUSTIFY);
    $panel->setTabsWidth(200);
    
    
    $panel->addTab('Home',    'tab1', 'data/tab1.json')->setActive(true);
    $panel->addTab('Profile', 'tab2', 'data/tab2.json');
    $panel->addTab('Disabled')->setDisabled(true);
    
    $tab_dropdown = $panel->addDropdown('Dropdown');
    $tab_dropdown->addItem('Tab title 3')->setDisabled(true);
    $tab_dropdown->addItem('Tab title 4', 'tab4', 'data/tab3.json');
    $tab_dropdown->addDivider();
    $tab_dropdown->addItem('Tab title 5', 'tab5', 'data/tab4.json');

    // Переопределение активного таба 
    $panel->setActiveTab('tab2');
    
    $panel->setContent('Your content 1');

    echo json_encode($panel->toArray());
```

Output 
```json
{
    "component": "coreui.panel",
    "id": "panel-id",
    "title": "Component Panel",
    "subtitle": "CoreUI Framework",
    "controls": [
      { "type": "button", "attr": { "class": "btn btn-secondary" }, "content": "Help" }
    ],
    "tabs": {
      "type": "tabs",
      "position": "top-left",
      "fill": "justify",
      "width": 200,
      "items": [
        {"id": "tab1", "title": "Home", "url": "data/tab1.json"},
        {"id": "tab2", "title": "Profile", "active": true, "url": "data/tab2.json"},
        {"id": "tab3", "title": "Disabled", "disabled": true},
        {
          "title": "Dropdown",
          "type": "dropdown",
          "items": [
            {"id": "tab4", "title": "Tab title 3", "disabled": true},
            {"id": "tab5", "title": "Tab title 4", "url": "data/tab3.json"},
            {"type": "divider"},
            {"id": "tab6","title": "Tab title 5", "url": "data/tab4.json"}
          ]
        }
      ]
    },
    "content": "Your content 1"
}
```