<?php

namespace AppBundle\Services;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PaginationService
{
    protected $knpPaginator;
    protected $doctrine;

    public function __construct(RegistryInterface $doctrine, PaginatorInterface $knpPaginator)
    {
        $this->doctrine = $doctrine;
        $this->knpPaginator = $knpPaginator;
    }

    /**
     * @param Request $request
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function paginationSearchQuery(Request $request)
    {
        $title = $request->get('title');
        $em = $this->doctrine->getManager();
        $query = $em->getRepository('AppBundle:Post')->findByTitleQuery($title);
        $pagination = $this->knpPaginator->paginate(
            $query,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $pagination;
    }

    /**
     * @param Request $request
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function paginationLoadMoreQuery(Request $request)
    {
        $em = $this->doctrine->getManager();
        $dql   = "SELECT a FROM AppBundle:Post a";
        $query = $em->createQuery($dql);
        $pagination = $this->knpPaginator->paginate(
            $query,
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $pagination;
    }
}