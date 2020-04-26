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
  generalSort = 'newestFirst';
  sort = 'creationDatetime';
  dir = 'desc';

  constructor(private itemService: ItemService) {
  }

    responsedata = new Array<Item>();

    confirm_msg = '';

    updateSort() : void {
      if(this.generalSort == 'newestFirst' || this.generalSort == 'oldestFirst') {
          this.sort = 'creationDatetime';
          if(this.generalSort == 'newestFirst') {
            this.dir = 'desc';
          }
          else {
            this.dir = 'asc';
          }
      }
      else {
          this.sort = 'price';
          if(this.generalSort == 'lowToHigh') {
            this.dir = 'asc';
          }
          else {
            this.dir = 'desc';
          }
      }
    }

    handleChange(event) {
      this.generalSort = event.target.value;
      this.updateSort();
      this.getShopItems(this.sort, this.dir);
    }

    // get all items
    getShopItems(sort:string, dir:string): void {
        this.itemService.getItem(sort, dir)
           .subscribe((res) => {
               var resArr = res['content'];
               for (var i = 0; i < resArr['length']; i++) {
                   this.responsedata[i] = resArr[i];
               }});
    }

    ngOnInit(): void {
        this.generalSort = 'newestFirst';
        this.sort = 'creationDatetime';
        this.dir = 'desc';
        this.getShopItems(this.sort, this.dir);
    }

  }