<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param starsamount current_balance starsamount available_balance starsamount overall_revenue true withdrawal_enabled int next_withdrawal_at
 * @return StarsRevenueStatus
 */

final class StarsRevenueStatus extends Instance {
	public function request(object $current_balance,object $available_balance,object $overall_revenue,? true $withdrawal_enabled = null,? int $next_withdrawal_at = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfebe5491);
		$flags = 0;
		$flags |= is_null($withdrawal_enabled) ? 0 : (1 << 0);
		$flags |= is_null($next_withdrawal_at) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($current_balance->read());
		$writer->write($available_balance->read());
		$writer->write($overall_revenue->read());
		if(is_null($next_withdrawal_at) === false):
			$writer->writeInt($next_withdrawal_at);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['withdrawal_enabled'] = true;
		else:
			$result['withdrawal_enabled'] = false;
		endif;
		$result['current_balance'] = $reader->tgreadObject();
		$result['available_balance'] = $reader->tgreadObject();
		$result['overall_revenue'] = $reader->tgreadObject();
		if($flags & (1 << 1)):
			$result['next_withdrawal_at'] = $reader->readInt();
		else:
			$result['next_withdrawal_at'] = null;
		endif;
		return new self($result);
	}
}

?>