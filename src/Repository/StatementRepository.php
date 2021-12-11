<?php
declare(strict_types=1);

namespace Src\Repository;

use Illuminate\Support\Collection;
use Src\Models\BillPay;
use Src\Models\BillReceive;

class StatementRepository implements StatementRepositoryInterface
{


    /**
     * @param string $dateStart
     * @param string $dateEnd
     * @param int $userId
     * @return array
     */
    public function all(string $dateStart, string $dateEnd, int $userId): array
    {
        //select from bill_pays left join category_costs
        $billPays = BillPay::query()
            ->selectRaw('bill_pays.*, category_costs.name as category_name')
            ->leftJoin('category_costs', 'category_costs.id', '=', 'bill_pays.category_cost_id')
            ->whereBetween('date_launch', [$dateStart, $dateEnd])
            ->where('bill_pays.user_id', $userId)
            ->get();

        $billReceives = BillReceive::query()
            ->whereBetween('date_launch', [$dateStart, $dateEnd])
            ->where('user_id', $userId)
            ->get();

        //Collection [0 => BillPay, 1 => BillPay..]
        //Collection [0 => BillReceive,1 => BillReceive..]

        $collection = new Collection(array_merge_recursive($billPays->toArray(), $billReceives->toArray()));
        $statements = $collection->sortByDesc('date_launch');
        return [
            'statements' => $statements,
            'total_pays' => $billPays->sum('value'),
            'total_receives' => $billReceives->sum('value')
        ];
    }
}