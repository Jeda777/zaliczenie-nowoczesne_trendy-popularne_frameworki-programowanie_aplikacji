import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { ApiService } from './api-service';

@Injectable({
  providedIn: 'root',
})
export class Auth {
  private authSubject = new BehaviorSubject<number | null>(null);
  authObservable = this.authSubject.asObservable();

  constructor(private apiService: ApiService) {}

  setAuthData(data: number) {
    this.authSubject.next(data);
  }

  getAuthData(): number | null {
    return this.authSubject.getValue();
  }
}
