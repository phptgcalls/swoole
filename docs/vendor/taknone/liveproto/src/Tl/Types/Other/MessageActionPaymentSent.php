<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string currency long total_amount true recurring_init true recurring_used string invoice_slug int subscription_until_date
 * @return MessageAction
 */

final class MessageActionPaymentSent extends Instance {
	public function request(string $currency,int $total_amount,? true $recurring_init = null,? true $recurring_used = null,? string $invoice_slug = null,? int $subscription_until_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc624b16e);
		$flags = 0;
		$flags |= is_null($recurring_init) ? 0 : (1 << 2);
		$flags |= is_null($recurring_used) ? 0 : (1 << 3);
		$flags |= is_null($invoice_slug) ? 0 : (1 << 0);
		$flags |= is_null($subscription_until_date) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($currency);
		$writer->writeLong($total_amount);
		if(is_null($invoice_slug) === false):
			$writer->tgwriteBytes($invoice_slug);
		endif;
		if(is_null($subscription_until_date) === false):
			$writer->writeInt($subscription_until_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['recurring_init'] = true;
		else:
			$result['recurring_init'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['recurring_used'] = true;
		else:
			$result['recurring_used'] = false;
		endif;
		$result['currency'] = $reader->tgreadBytes();
		$result['total_amount'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['invoice_slug'] = $reader->tgreadBytes();
		else:
			$result['invoice_slug'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['subscription_until_date'] = $reader->readInt();
		else:
			$result['subscription_until_date'] = null;
		endif;
		return new self($result);
	}
}

?>