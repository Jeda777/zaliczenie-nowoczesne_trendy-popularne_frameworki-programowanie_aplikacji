import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { ApiService } from '../services/api-service';
import { Auth } from '../services/auth';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: false,
  templateUrl: './login.html',
  styleUrl: './login.scss',
})
export class Login implements OnInit {
  protected title = 'app-auth';
  public form: any;

  constructor(
    private fb: FormBuilder,
    private apiService: ApiService,
    private auth: Auth,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.form = this.fb.group({
      username: ['', [Validators.required]],
      password: ['', [Validators.required]],
    });
  }

  submitForm() {
    if (!this.form.valid) return;
    this.apiService
      .register(this.form.value.username, this.form.value.password)
      .subscribe(
        (res) => {
          this.auth.setAuthData(res.id);
          this.form.reset();
        },
        (err) => {
          this.apiService
            .login(this.form.value.username, this.form.value.password)
            .subscribe(
              (res) => {
                console.log(res);
                this.auth.setAuthData(res.user.id);
                this.form.reset();
                this.router.navigateByUrl('');
              },
              (err) => {
                console.log(err);
              }
            );
        }
      );
  }
}
