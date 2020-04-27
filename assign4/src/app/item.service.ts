import { Injectable } from '@angular/core';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';

import { Item } from './item';


@Injectable({
  providedIn: 'root'
})
export class ItemService {

  constructor(private http: HttpClient) { }

  sendItemRequest(sort: any, dir: any): Observable<any> {
    return this.http.post('http://localhost/hoos-thrifting/php/shop-db.php', {sort, dir});
  }

  getItem(sort: string, dir: string): Observable<Item[]> {
     return this.sendItemRequest(sort, dir);
  }

}
