<?php

namespace PMM\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use PMM\PlatformBundle\Repository\CategoryRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', DateType::class)
            ->add('title', TextType::class)
            ->add('author', TextType::class)
            ->add('content', CkeditorType::class)
            ->add('image', ImageType::class)
            ->add('categories', CollectionType::class, array(
                'entry_type' => CategoryType::class,
                'allow_add' => true,
                'allow_delete' => true
                ))
            ->add('save', SubmitType::class);

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,

            function(FormEvent $event){

                $advert = $event->getData();

                if(null === $advert){
                    return;
                }

                if(!$advert->getPublished() || null === $advert->getId()){

                    $event->getForm()->add('published', checkboxType::class, 
                        array('required' => false));
                }else{
                    $event->getForm()->remove('published');
                }
            }
            );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PMM\PlatformBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pmm_platformbundle_advert';
    }


}
