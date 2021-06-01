<?php

declare(strict_types=1);

namespace Richi\CashFlow\Infrastructure\Delivery\Http;

use Richi\CashFlow\Application\Account\AccountCreateRequest;
use Richi\CashFlow\Application\Account\AccountCreateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as Route;

/**
 * @Route("/account")
 *
 * @author Nikolay Ryabkov <ZeroGravity.82@gmail.com>
 */
class AccountController extends AbstractController
{
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
     * @param Request              $request
     * @param AccountCreateService $accountCreateService
     *
     * @return Response
     */
    public function new(Request $request, AccountCreateService $accountCreateService): Response
    {
        $request = new AccountCreateRequest(
            'test_name',
            'test_description',
            null,
            0,
            false
        );
        $accountCreateService->execute($request);

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
}
