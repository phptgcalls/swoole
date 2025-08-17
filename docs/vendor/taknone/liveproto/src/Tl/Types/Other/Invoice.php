<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string currency Vector<LabeledPrice> prices true test true name_requested true phone_requested true email_requested true shipping_address_requested true flexible true phone_to_provider true email_to_provider true recurring long max_tip_amount Vector<long> suggested_tip_amounts string terms_url int subscription_period
 * @return Invoice
 */

final class Invoice extends Instance {
	public function request(string $currency,array $prices,? true $test = null,? true $name_requested = null,? true $phone_requested = null,? true $email_requested = null,? true $shipping_address_requested = null,? true $flexible = null,? true $phone_to_provider = null,? true $email_to_provider = null,? true $recurring = null,? int $max_tip_amount = null,? array $suggested_tip_amounts = null,? string $terms_url = null,? int $subscription_period = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x49ee584);
		$flags = 0;
		$flags |= is_null($test) ? 0 : (1 << 0);
		$flags |= is_null($name_requested) ? 0 : (1 << 1);
		$flags |= is_null($phone_requested) ? 0 : (1 << 2);
		$flags |= is_null($email_requested) ? 0 : (1 << 3);
		$flags |= is_null($shipping_address_requested) ? 0 : (1 << 4);
		$flags |= is_null($flexible) ? 0 : (1 << 5);
		$flags |= is_null($phone_to_provider) ? 0 : (1 << 6);
		$flags |= is_null($email_to_provider) ? 0 : (1 << 7);
		$flags |= is_null($recurring) ? 0 : (1 << 9);
		$flags |= is_null($max_tip_amount) ? 0 : (1 << 8);
		$flags |= is_null($suggested_tip_amounts) ? 0 : (1 << 8);
		$flags |= is_null($terms_url) ? 0 : (1 << 10);
		$flags |= is_null($subscription_period) ? 0 : (1 << 11);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($currency);
		$writer->tgwriteVector($prices,'LabeledPrice');
		if(is_null($max_tip_amount) === false):
			$writer->writeLong($max_tip_amount);
		endif;
		if(is_null($suggested_tip_amounts) === false):
			$writer->tgwriteVector($suggested_tip_amounts,'long');
		endif;
		if(is_null($terms_url) === false):
			$writer->tgwriteBytes($terms_url);
		endif;
		if(is_null($subscription_period) === false):
			$writer->writeInt($subscription_period);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['test'] = true;
		else:
			$result['test'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['name_requested'] = true;
		else:
			$result['name_requested'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['phone_requested'] = true;
		else:
			$result['phone_requested'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['email_requested'] = true;
		else:
			$result['email_requested'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['shipping_address_requested'] = true;
		else:
			$result['shipping_address_requested'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['flexible'] = true;
		else:
			$result['flexible'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['phone_to_provider'] = true;
		else:
			$result['phone_to_provider'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['email_to_provider'] = true;
		else:
			$result['email_to_provider'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['recurring'] = true;
		else:
			$result['recurring'] = false;
		endif;
		$result['currency'] = $reader->tgreadBytes();
		$result['prices'] = $reader->tgreadVector('LabeledPrice');
		if($flags & (1 << 8)):
			$result['max_tip_amount'] = $reader->readLong();
		else:
			$result['max_tip_amount'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['suggested_tip_amounts'] = $reader->tgreadVector('long');
		else:
			$result['suggested_tip_amounts'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['terms_url'] = $reader->tgreadBytes();
		else:
			$result['terms_url'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['subscription_period'] = $reader->readInt();
		else:
			$result['subscription_period'] = null;
		endif;
		return new self($result);
	}
}

?>