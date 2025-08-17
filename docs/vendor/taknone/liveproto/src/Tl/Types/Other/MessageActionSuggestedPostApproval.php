<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true rejected true balance_too_low string reject_comment int schedule_date starsamount price
 * @return MessageAction
 */

final class MessageActionSuggestedPostApproval extends Instance {
	public function request(? true $rejected = null,? true $balance_too_low = null,? string $reject_comment = null,? int $schedule_date = null,? object $price = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xee7a1596);
		$flags = 0;
		$flags |= is_null($rejected) ? 0 : (1 << 0);
		$flags |= is_null($balance_too_low) ? 0 : (1 << 1);
		$flags |= is_null($reject_comment) ? 0 : (1 << 2);
		$flags |= is_null($schedule_date) ? 0 : (1 << 3);
		$flags |= is_null($price) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		if(is_null($reject_comment) === false):
			$writer->tgwriteBytes($reject_comment);
		endif;
		if(is_null($schedule_date) === false):
			$writer->writeInt($schedule_date);
		endif;
		if(is_null($price) === false):
			$writer->write($price->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['rejected'] = true;
		else:
			$result['rejected'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['balance_too_low'] = true;
		else:
			$result['balance_too_low'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['reject_comment'] = $reader->tgreadBytes();
		else:
			$result['reject_comment'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['schedule_date'] = $reader->readInt();
		else:
			$result['schedule_date'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['price'] = $reader->tgreadObject();
		else:
			$result['price'] = null;
		endif;
		return new self($result);
	}
}

?>