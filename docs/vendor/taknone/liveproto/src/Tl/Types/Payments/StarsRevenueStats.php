<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param statsgraph revenue_graph starsrevenuestatus status double usd_rate statsgraph top_hours_graph
 * @return payments.StarsRevenueStats
 */

final class StarsRevenueStats extends Instance {
	public function request(object $revenue_graph,object $status,float $usd_rate,? object $top_hours_graph = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6c207376);
		$flags = 0;
		$flags |= is_null($top_hours_graph) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($top_hours_graph) === false):
			$writer->write($top_hours_graph->read());
		endif;
		$writer->write($revenue_graph->read());
		$writer->write($status->read());
		$writer->writeDouble($usd_rate);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['top_hours_graph'] = $reader->tgreadObject();
		else:
			$result['top_hours_graph'] = null;
		endif;
		$result['revenue_graph'] = $reader->tgreadObject();
		$result['status'] = $reader->tgreadObject();
		$result['usd_rate'] = $reader->readDouble();
		return new self($result);
	}
}

?>