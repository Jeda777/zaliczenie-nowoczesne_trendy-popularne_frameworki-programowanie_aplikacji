import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  constructor(private http: HttpClient) {}

  getMessages(): Observable<any> {
    return this.http.get('/api/message');
  }

  createMessage(username: string, message: string) {
    return this.http.post('api/message', {
      message,
      username,
    });
  }
}
