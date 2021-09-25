<?php

declare(strict_types=1);

namespace Richi\CashFlow\Infrastructure\Delivery\Http;

use Richi\CashFlow\Application\Account\CreateAccount\CreateAccountRequest;
use Richi\CashFlow\Application\Account\CreateAccount\CreateAccount;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as Route;

/**
 * @Route("/account")
 *
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
final class AccountController extends AbstractController
{
    /**
     * @param CreateAccount $createAccount
     */
    public function __construct(
        private CreateAccount $createAccount,
    ) {}

    /**
     * @Route("/", name="account_index")
     *
     * @return Response
     */
    public function index(): Response
    {


        return new Response('index');
    }

    /**
     * @Route("/new", name="account_new")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $request = new CreateAccountRequest(
            'test_name',
            'test_description',
            null,
            0,
            false
        );
        $accountIdString = $this->getCreateAccount()->execute($request);

        return new Response('new');
    }

    /**
     * @Route("/edit/{accountId}", name="account_edit")
     *
     * @param string $accountId
     *
     * @return Response
     */
    public function edit(string $accountId): Response
    {


        return new Response('edit '.$accountId);
    }

    /**
     * @return CreateAccount
     */
    private function getCreateAccount(): CreateAccount
    {
        return $this->createAccount;
    }
}
