<?php


namespace App\Services\PSP;


use App\Entity\Store;
use Stripe\Collection;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\StripeClient;
use Stripe\Subscription;

class PSPServices
{

    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    public function getCustomerByStore(Store $store): Customer
    {
        return $this->stripe->customers->retrieve($store->stripe_customer_id);
    }

    public function getPaymentMethod(string $idPaymentMethod): PaymentMethod
    {
        return $this->stripe->paymentMethods->retrieve(
            $idPaymentMethod
        );
    }

    public function getAllSubscriptionsByStore(Store $store): Collection
    {
        return $this->stripe->subscriptions->all([
            'customer' => $store->stripe_customer_id
        ]);
    }

    public function getAllPaymentMethodsByCustomer(Customer $customer): Collection
    {
        return $this->stripe->paymentMethods->all([
            'customer' => $customer->id,
            'type' => 'card'
        ]);
    }

    public function createCustomer(array $datas)
    {
        return $this->stripe->customers->create($datas);
    }

    public function createSubscription(Customer $customer, $amount): Subscription
    {
        return $this->stripe->subscriptions->create([
        'customer' => $customer->id,
        'items' => [
                ['price' => $amount],
            ],
        ]);
    }

    public function updateCustomerByStore(Store $store, PaymentMethod $paymentMethod): Customer
    {
        return $this->stripe->customers->update(
            $store->stripe_customer_id,
            ['invoice_settings' => [
                'default_payment_method' => $paymentMethod->id
            ]]
        );
    }

    public function updateSubscriptionById(Subscription $subscription, string $price): Subscription
    {
        return $this->stripe->subscriptions->update(
            $subscription->id,
            [
                'cancel_at_period_end' => false,
                'proration_behavior' => 'create_prorations',
                'items' => [
                    [
                        'id' => $subscription->items->data[0]->id,
                        'price' => $price,
                    ],
                ],
            ],
        );
    }

    public function deleteSubscription(Collection $subscription)
    {
        return $this->stripe->subscriptions->cancel(
            $subscription->data[0]->id,
            []
        );
    }

    public function detachPaymentMethod(string $paymentMethodId)
    {
        return $this->stripe->paymentMethods->detach(
            $paymentMethodId
        );
    }
}
