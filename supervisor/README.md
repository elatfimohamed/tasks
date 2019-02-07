Path:

```
/etc/supervisor/conf.d/tasks.mohamedelatfi.scool.cat/.conf
```

Contingut: 

LOCAL:
```
[program:laravel-worker-tasks-mohamedelatfi-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/elatfi/Code/mohamed/tasks/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=sergi
numprocs=8
redirect_stderr=true
stdout_logfile=/home/elatfi/Code/mohamed/tasks/tasks/storage/logs/worker.log
```

EXPLOTACIO:

```
[program:laravel-worker-tasks-mohamedelatfi-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/forge/app.com/artisan queue:work sqs --sleep=3 --tries=3
autostart=true
autorestart=true
user=forge
numprocs=8
redirect_stderr=true
stdout_logfile=/home/forge/app.com/worker.log
```
