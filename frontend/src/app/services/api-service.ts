import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Auth } from './auth';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  constructor(private http: HttpClient) {}

  getMessages(): Observable<any> {
    return this.http.get('/api/message');
  }

  createMessage(userId: string, message: string) {
    return this.http.post('api/message', {
      message,
      userId,
    });
  }

  register(username: string, password: string): Observable<any> {
    return this.http.post('/api/user/register', {
      username,
      password,
    });
  }

  login(username: string, password: string): Observable<any> {
    return this.http.post('/api/user/login', {
      username,
      password,
    });
  }
}
