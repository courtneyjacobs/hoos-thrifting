import { Injectable } from '@angular/core';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';

import { Item } from './item';


@Injectable({
  providedIn: 'root'
})
export class ItemService {

  item = new Item(0, '', '', '', '', '', '', '', '', 0);

  constructor(private http: HttpClient) { }

  sendRequest(data: any): Observable<any> {
    // return this.http.post('http://localhost/cs4640/inclass11/ngphp-post.php', data, {responseType: 'text'});
    // return this.http.post('http://localhost/cs4640/inclass11/ngphp-post.php', data, {responseType: 'json'});
    return this.http.post('http://localhost/hoos-thrifting/php/item-db.php', data);
  }

  sendItem(data): Observable<Item[]> {
     return this.sendRequest(data);
  }
}
