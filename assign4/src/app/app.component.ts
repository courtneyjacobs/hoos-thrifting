import { Component } from '@angular/core';
import { Item } from './item';
import { ItemService } from './item.service';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import {Observable} from 'rxjs';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {

  title = 'Shop';
  url = 'http://localhost:4200';
  hasAccess = 'denied';
  sort='';

  constructor(private itemService: ItemService) {}

    responsedata = new Array<Item>();

    confirm_msg = '';

    // get all items
    getShopItems(): void {
        this.itemService.getSession()
           .subscribe((res) => {
               this.hasAccess = res['session'];
             });
        this.itemService.getItem(this.sort)
           .subscribe((res) => {
               var resArr = res['content'];
               for (var i = 0; i < resArr['length']; i++) {
                   this.responsedata[i] = resArr[i];
               }});
    }

    ngOnInit(): void {
        this.sort = '';
        this.getShopItems();
    }

  }