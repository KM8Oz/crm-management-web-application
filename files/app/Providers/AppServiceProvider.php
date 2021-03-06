<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Call;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contract;
use App\Models\EmailTemplate;
use App\Models\Event;
use App\Models\EventBooking;
use App\Models\EventNotes;
use App\Models\EventPayments;
use App\Models\EventTasks;
use App\Models\InviteUser;
use App\Models\Invoice;
use App\Models\InvoiceReceivePayment;
use App\Models\Lead;
use App\Models\Managers;
use App\Models\Meeting;
use App\Models\Opportunity;
use App\Models\Option;
use App\Models\Product;
use App\Models\Qtemplate;
use App\Models\Quotation;
use App\Models\Saleorder;
use App\Models\Salesteam;
use App\Models\Staff;
use App\Models\User;
use App\Repositories\BookingRepository;
use App\Repositories\BookingRepositoryEloquent;
use App\Repositories\CallRepository;
use App\Repositories\CallRepositoryEloquent;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\CompanyRepository;
use App\Repositories\CompanyRepositoryEloquent;
use App\Repositories\ContractRepository;
use App\Repositories\ContractRepositoryEloquent;
use App\Repositories\EmailTemplateRepository;
use App\Repositories\EmailTemplateRepositoryEloquent;
use App\Repositories\EventNotesRepository;
use App\Repositories\EventNotesRepositoryEloquent;
use App\Repositories\EventPaymentRepository;
use App\Repositories\EventPaymentRepositoryEloquent;
use App\Repositories\EventRepository;
use App\Repositories\EventRepositoryEloquent;
use App\Repositories\EventTasksRepository;
use App\Repositories\EventTasksRepositoryEloquent;
use App\Repositories\ExcelRepository;
use App\Repositories\ExcelRepositoryDefault;
use App\Repositories\InstallRepository;
use App\Repositories\InstallRepositoryEloquent;
use App\Repositories\InviteUserRepository;
use App\Repositories\InviteUserRepositoryEloquent;
use App\Repositories\InvoicePaymentRepository;
use App\Repositories\InvoicePaymentRepositoryEloquent;
use App\Repositories\InvoiceRepository;
use App\Repositories\InvoiceRepositoryEloquent;
use App\Repositories\LeadRepository;
use App\Repositories\LeadRepositoryEloquent;
use App\Repositories\ManagerRepository;
use App\Repositories\ManagerRepositoryEloquent;
use App\Repositories\MeetingRepository;
use App\Repositories\MeetingRepositoryEloquent;
use App\Repositories\OpportunityRepository;
use App\Repositories\OpportunityRepositoryEloquent;
use App\Repositories\OptionRepository;
use App\Repositories\OptionRepositoryEloquent;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryEloquent;
use App\Repositories\QuotationRepository;
use App\Repositories\QuotationRepositoryEloquent;
use App\Repositories\QuotationTemplateRepository;
use App\Repositories\QuotationTemplateRepositoryEloquent;
use App\Repositories\SalesOrderRepository;
use App\Repositories\SalesOrderRepositoryEloquent;
use App\Repositories\SalesTeamRepository;
use App\Repositories\SalesTeamRepositoryEloquent;
use App\Repositories\StaffRepository;
use App\Repositories\StaffRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use Cartalyst\Sentinel\Sentinel;
use Efriandika\LaravelSettings\Facades\Settings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Excel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->setDbConfigurations();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(DropboxServiceProvider::class);

        $this->app->bind(UserRepository::class, function ($app) {
            $sentinel = new Sentinel(
                $app['sentinel.persistence'],
                $app['sentinel.users'],
                $app['sentinel.roles'],
                $app['sentinel.activations'],
                $app['events']
            );
            return new UserRepositoryEloquent(new User(), $sentinel);
        });

        $this->app->bind(SalesTeamRepository::class, function ($app) {
            return new SalesTeamRepositoryEloquent(new Salesteam());
        });

        $this->app->bind(CallRepository::class, function ($app) {
            return new CallRepositoryEloquent(new Call());
        });

        $this->app->bind(CompanyRepository::class, function ($app) {
            return new CompanyRepositoryEloquent(new Company());
        });

        $this->app->bind(OpportunityRepository::class, function ($app) {
            return new OpportunityRepositoryEloquent(new Opportunity());
        });

        $this->app->bind(MeetingRepository::class, function ($app) {
            return new MeetingRepositoryEloquent(new Meeting());
        });

        $this->app->bind(QuotationRepository::class, function ($app) {
            return new QuotationRepositoryEloquent(new Quotation());
        });

        $this->app->bind(ProductRepository::class, function ($app) {
            return new ProductRepositoryEloquent(new Product());
        });

        $this->app->bind(CategoryRepository::class, function ($app) {
            return new CategoryRepositoryEloquent(new Category());
        });

        $this->app->bind(QuotationTemplateRepository::class, function ($app) {
            return new QuotationTemplateRepositoryEloquent(new Qtemplate());
        });

        $this->app->bind(InvoiceRepository::class, function ($app) {
            return new InvoiceRepositoryEloquent(new Invoice());
        });

        $this->app->bind(ContractRepository::class, function ($app) {
            return new ContractRepositoryEloquent(new Contract());
        });

        $this->app->bind(LeadRepository::class, function ($app) {
            return new LeadRepositoryEloquent(new Lead());
        });

        $this->app->bind(EventRepository::class, function ($app) {
            return new EventRepositoryEloquent(new Event());
        });

        $this->app->bind(ManagerRepository::class, function ($app) {
            return new ManagerRepositoryEloquent(new Managers());
        });

        $this->app->bind(BookingRepository::class, function ($app) {
            return new BookingRepositoryEloquent(new EventBooking());
        });

        $this->app->bind(EventNotesRepository::class, function ($app) {
            return new EventNotesRepositoryEloquent(new EventNotes());
        });

        $this->app->bind(EventTasksRepository::class, function ($app) {
            return new EventTasksRepositoryEloquent(new EventTasks());
        });

        $this->app->bind(EventPaymentRepository::class, function ($app) {
            return new EventPaymentRepositoryEloquent(new EventPayments());
        });

        $this->app->bind(SalesOrderRepository::class, function ($app) {
            return new SalesOrderRepositoryEloquent(new Saleorder());
        });

        $this->app->bind(InvoicePaymentRepository::class, function ($app) {
            return new InvoicePaymentRepositoryEloquent(new InvoiceReceivePayment());
        });

        $this->app->bind(ExcelRepository::class, function ($app) {

            $excel = new Excel(
                $app['phpexcel'],
                $app['excel.reader'],
                $app['excel.writer'],
                $app['excel.parsers.view']
            );

            return new ExcelRepositoryDefault($excel);
        });

        $this->app->bind(EmailTemplateRepository::class, function ($app) {
            return new EmailTemplateRepositoryEloquent(new EmailTemplate());
        });

        $this->app->bind(OptionRepository::class, function ($app) {
            return new OptionRepositoryEloquent(new Option());
        });

        $this->app->bind(InviteUserRepository::class, function ($app) {
            return new InviteUserRepositoryEloquent(new InviteUser());
        });

        $this->app->bind(InstallRepository::class, function ($app) {
            return new InstallRepositoryEloquent();
        });

    }

    private function setDbConfigurations()
    {
        try {
            //Pusher
            Config::set('broadcasting.connections.pusher.key', Settings::get('pusher_key'));
            Config::set('broadcasting.connections.pusher.secret', Settings::get('pusher_secret'));
            Config::set('broadcasting.connections.pusher.app_id', Settings::get('pusher_app_id'));

            //Backup Manager
            Config::set('laravel-backup.destination.filesystem', Settings::get('backup_type'));

            //DISK Amazon S3
            Config::set('filesystems.disks.s3.key', Settings::get('disk_aws_key'));
            Config::set('filesystems.disks.s3.secret', Settings::get('disk_aws_secret'));
            Config::set('filesystems.disks.s3.region', Settings::get('disk_aws_region'));
            Config::set('filesystems.disks.s3.bucket', Settings::get('disk_aws_bucket'));

            //DISK Dropbox
            //Config::set('filesystems.disks.dropbox.key', Settings::get('disk_dbox_key'));
            Config::set('filesystems.disks.dropbox.secret', Settings::get('disk_dbox_secret'));
            //Config::set('filesystems.disks.dropbox.app', Settings::get('disk_dbox_app'));
            Config::set('filesystems.disks.dropbox.token', Settings::get('disk_dbox_token'));

            //Stripe
            Config::set('services.stripe.secret', Settings::get('stripe_secret'));
            Config::set('services.stripe.key', Settings::get('stripe_publishable'));

            //Mailserver
//            Config::set('mail.driver', ((Settings::get('email_driver') == null) ? Settings::get('email_driver') : 'mail'));
//            Config::set('mail.host', Settings::get('email_host'));
//            Config::set('mail.port', Settings::get('email_port'));
//            Config::set('mail.username', Settings::get('email_username'));
//            Config::set('mail.password', Settings::get('email_password'));

        } catch (\Exception $e) {

        }
    }
}
