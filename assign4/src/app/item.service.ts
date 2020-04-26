import { Injectable } from '@angular/core';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';

import { Item } from './item';


@Injectable({
  providedIn: 'root'
})
export class ItemService {

  constructor(private http: HttpClient) { }

  sendItemRequest(data: any): Observable<any> {
    return this.http.post('http://localhost/hoos-thrifting/php/shop-db.php', data);
  }

  getItem(func: string): Observable<Item[]> {
     return this.sendItemRequest(func);
  }

  getSession(): Observable<any> {
    return this.sendSessionRequest();
  }

  sendSessionRequest() : Observable<any> {
    return this.http.post('http://localhost/hoos-thrifting/php/session-db.php', {withCredentials: true, responseType: 'text' as 'json'});
  }

}
